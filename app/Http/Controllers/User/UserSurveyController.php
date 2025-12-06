<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SurveyQuestion;
use App\Models\SurveyAnswer;
use App\Models\SurveyResult;
use App\Models\Major;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserSurveyController extends Controller
{
    /**
     * Hiển thị form khảo sát
     */
    public function index()
    {
        $questions = SurveyQuestion::orderBy('id')->get();

        return view('user.survey', compact('questions'));
    }

    /**
     * Lưu kết quả khảo sát
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để làm khảo sát.');
        }

        $answers = $request->input('answers', []);

        // Xóa câu trả lời cũ
        SurveyAnswer::where('user_id', $userId)->delete();
        
        $dbQuestionsAnswer = "";

        foreach ($answers as $questionId => $value) {
            SurveyAnswer::create([
                'user_id' => $userId,
                'question_id' => $questionId,
                'answer' => trim($value),
            ]);

            $q = SurveyQuestion::find($questionId);
            $a = trim($value);
            $dbQuestionsAnswer .= "Q " . $q->question . " A " . $a . ", ";
        }

        $dbMajor = Major::all()->pluck('name', 'id')->toArray();

        $stringMajor = collect($dbMajor)
            ->map(function ($name, $id) {
                return "{$id} - {$name}";
            })
            ->implode('; ');

        $prompt = "Dữ liệu khảo sát: " . $dbQuestionsAnswer . 
        "Tất cả các ngành: " . $stringMajor . 
        ". Tìm ngành học phù hợp nhất dựa trên câu trả lời khảo sát ở trên. 1 dòng kết quả tốt nhất, phải đúng định dạng: Mã ngành - Số điểm (0-100).";

        // Gọi OpenRouter API
        $apiKey = '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'; // Thay bằng khóa từ https://openrouter.ai/settings
        $endpoint = 'https://openrouter.ai/api/v1/chat/completions';

        $response = Http::withHeaders([
            'Authorization' => "Bearer $apiKey",
            'Content-Type' => 'application/json',
            'HTTP-Referer' => 'https://yourdomain.com/', // Cần thiết cho OpenRouter
            'X-Title' => 'My AI Chatbot'                 // Tuỳ chọn
        ])->post($endpoint, [
            'model' => 'openai/gpt-oss-20b:free', // hoặc gpt-3.5-turbo, meta-llama, mistral...
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.7,
            'max_tokens' => 30000,
        ]);

        if ($response->failed()) {
            return redirect()->back()->with('error', 'Hệ thống AI hiện tại không khả dụng.');
        }

        $data = $response->json();
        $answer = $data['choices'][0]['message']['content'] ?? null;

        if (!$answer) {
            return redirect()->back()->with('error', 'Hệ thống AI trả về dữ liệu không hợp lệ.');
        }

        // Xóa các kết quả cũ của người dùng
        SurveyResult::where('user_id', $userId)->delete();
        
        $lines = explode("\n", trim($answer));

        foreach ($lines as $line) {
            // "1 - 90" → ["1", "90"]
            [$majorId, $score] = array_map('trim', explode('-', $line));

            SurveyResult::updateOrCreate(
                [
                    'user_id'             => $userId,
                    'suggested_major_id'  => (int)$majorId, // vì bảng của mày dùng tên này thay cho major_id
                ],
                [
                    'score' => (int)$score,
                ]
            );
        }
        return redirect()->route('survey.result')->with('success', 'Đã lưu kết quả khảo sát.');
    }

    /**
     * Hiển thị kết quả khảo sát
     */
    public function result()
    {
        $userId = Auth::id();

        $result = SurveyResult::where('user_id', $userId)->latest()->first();

        if (!$result) {
            return redirect()->route('user.survey')->with('error', 'Bạn chưa làm khảo sát.');
        }

        $major = Major::with('universities')->find($result->suggested_major_id);

        $answers = SurveyAnswer::where('user_id', $userId)
            ->with('question')
            ->orderBy('question_id')
            ->get();

        return view('user.survey_result', compact('major', 'result', 'answers'));
    }

}
