<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\SurveyResult;
use App\Models\Major;

class ChatController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $messages = ChatLog::where('user_id', $userId)->orderBy('created_at')->get();
        return view('user.chat', compact('messages'));
    }

    public function send(Request $request)
    {
        $user = Auth::user();

        // Kiểm tra người dùng đã làm khảo sát và có kết quả khảo sát chưa
        $userId = $user->id;
        $hasSurveyResult = SurveyResult::where('user_id', $userId)->exists();
        if(!$hasSurveyResult){
            $reply = "Xin lỗi, bạn chưa hoàn thành khảo sát và không thể sử dụng chức năng chat.";
            return response()->json(['reply' => nl2br(e($reply))]);
        }

        // $text = trim($request->input('message'));
        $text = "chào bạn";
        if (!$text){
            $reply = "Vui lòng nhập câu hỏi của bạn.";
            return response()->json(['reply' => nl2br(e($reply))]);
        }

        // Vào trong kết quả khảo sát lấy ra suggested_major_id của người dùng
        $surveyResult = SurveyResult::where('user_id', $userId)->first();
        $suggestedMajorId = $surveyResult->suggested_major_id;

        // Lấy tên ngành từ bảng majors
        $major = Major::find($suggestedMajorId);
        $majorName = $major ? $major->name : 'không xác định';

        // Vào major_university lấy danh sách trường đại học theo ngành
        $universities = $major ? $major->universities()->pluck('name')->toArray() : [];
        $universityList = implode(', ', $universities);

        // Vào career_paths lấy danh sách hướng nghề theo ngành
        $careerPaths = $major ? $major->careerPaths()->pluck('title')->toArray() : [];
        $careerPathList = implode(', ', $careerPaths);

        $prompt = "Ngành học tương lai của người này là: {$majorName}.".
                 "Hãy trả lời tự nhiên cho câu hỏi: {$text}"; 
        
        // Lưu câu hỏi người dùng
        $msg = ChatLog::create([
            'user_id' => $user->id,
            'message' => $text,
        ]);

        try {
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
                'max_tokens' => 30000,
            ]);

            if ($response->failed()) {
                $reply = "Xin lỗi, không thể kết nối đến hệ thống AI tại thời điểm này.";
                return response()->json(['reply' => nl2br(e($reply))]);
            }

            $data = $response->json();
            $reply = $data['choices'][0]['message']['content'] ?? null;

            if (!$reply) {
                $reply = "Xin lỗi, hệ thống AI trả về dữ liệu không hợp lệ.";
                return response()->json(['reply' => nl2br(e($reply))]);
            }
        } catch (\Exception $e) {
            $reply = "Xin lỗi, hệ thống đang bận. Vui lòng thử lại sau.";
        }

        // Lưu phản hồi AI
        $msg->update(['reply' => $reply]);

        return response()->json(['reply' => nl2br(e($reply))]);
    }
}
