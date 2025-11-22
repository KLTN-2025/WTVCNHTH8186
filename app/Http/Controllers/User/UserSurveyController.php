<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SurveyQuestion;
use App\Models\SurveyAnswer;
use App\Models\SurveyResult;
use App\Models\Major;
use Illuminate\Support\Facades\Auth;

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

        foreach ($answers as $questionId => $value) {
            SurveyAnswer::create([
                'user_id' => $userId,
                'question_id' => $questionId,
                'answer' => trim($value),
            ]);
        }

        // Tạo kết quả mẫu
        $suggestedMajor = Major::inRandomOrder()->first();

        SurveyResult::updateOrCreate(
            ['user_id' => $userId],
            [
                'suggested_major_id' => $suggestedMajor->id,
                'score' => rand(60, 100),
                'created_at' => now(),
            ]
        );

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
