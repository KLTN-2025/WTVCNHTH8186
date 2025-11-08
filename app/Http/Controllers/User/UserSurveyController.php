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
        // Lấy toàn bộ câu hỏi khảo sát
        $questions = SurveyQuestion::orderBy('id')->get();

        // Nếu trường options (danh sách lựa chọn) được lưu trong DB dưới dạng chuỗi 'A|B|C'
        // thì chuyển sang mảng để render
        foreach ($questions as $q) {
            if (property_exists($q, 'options_text')) {
                $q->options = explode('|', $q->options_text);
            } elseif (!isset($q->options)) {
                // fallback nếu bạn lưu ở cột khác hoặc cần gắn thủ công
                $q->options = ['Đồng ý', 'Không đồng ý'];
            }
        }

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

        // Xóa câu trả lời cũ nếu người dùng làm lại khảo sát
        SurveyAnswer::where('user_id', $userId)->delete();

        foreach ($answers as $questionId => $value) {
            SurveyAnswer::create([
                'user_id' => $userId,
                'question_id' => $questionId,
                'answer' => is_array($value) ? implode(', ', $value) : $value,
            ]);
        }

        /**
         * Xử lý logic tính toán hoặc gọi AI
         * Ở đây ví dụ gợi ý ngẫu nhiên một ngành phù hợp.
         * Bạn có thể thay bằng thuật toán gợi ý thật hoặc API GPT.
         */
        $suggestedMajor = Major::inRandomOrder()->first();

        SurveyResult::updateOrCreate(
            ['user_id' => $userId],
            [
                'suggested_major_id' => $suggestedMajor->id,
                'score' => rand(60, 100),
                'created_at' => now(),
            ]
        );

        return redirect()->route('user.survey.result')->with('success', 'Đã lưu kết quả khảo sát.');
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

        $major = Major::find($result->suggested_major_id);

        return view('user.survey_result', compact('major', 'result'));
    }
}
