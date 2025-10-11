<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SurveyQuestion;
use App\Models\SurveyAnswer;
use App\Models\SurveyResult;
use App\Models\Major;
use App\Models\AdminLog;

class SurveyController extends Controller
{
    /**
     * Hiển thị form khảo sát cho người dùng
     */
    public function index()
    {
        $questions = SurveyQuestion::orderBy('id')->get();
        return view('survey.index', compact('questions'));
    }

    /**
     * Xử lý lưu kết quả khảo sát
     */
    public function store(Request $request)
    {
        $messages = [
            'answers.required' => 'Vui lòng trả lời khảo sát.',
            'answers.array'    => 'Dữ liệu khảo sát không hợp lệ.',
        ];

        $data = $request->validate([
            'answers' => 'required|array', // answers[question_id] = 'câu trả lời'
        ], $messages);

        $userId = Auth::id();

        DB::transaction(function () use ($data, $userId) {
            foreach ($data['answers'] as $qid => $ans) {
                SurveyAnswer::create([
                    'user_id'     => $userId,
                    'question_id' => (int)$qid,
                    'answer'      => is_array($ans) ? implode(', ', $ans) : (string)$ans,
                ]);
            }

            // Gợi ý ngành học đơn giản dựa theo từ khóa
            $flat = strtolower(
                implode(' ', array_map(fn($v) => is_array($v) ? implode(' ', $v) : $v, $data['answers']))
            );
            $suggested = null;

            if (str_contains($flat, 'công nghệ') || str_contains($flat, 'lập trình') || str_contains($flat, 'máy tính') || str_contains($flat, 'toán')) {
                $suggested = Major::where('name', 'like', '%Công nghệ thông tin%')->value('id');
            } elseif (str_contains($flat, 'kinh doanh') || str_contains($flat, 'marketing') || str_contains($flat, 'giao tiếp')) {
                $suggested = Major::where('name', 'like', '%Quản trị kinh doanh%')->value('id');
            }

            SurveyResult::create([
                'user_id'            => $userId,
                'suggested_major_id' => $suggested,
                'score'              => 0,
            ]);
        });

        // ✅ Ghi log lưu khảo sát
        AdminLog::record(
            'Lưu khảo sát định hướng',
            "Người dùng ID {$userId} đã hoàn thành khảo sát định hướng ngành học."
        );

        return back()->with('success', 'Đã lưu khảo sát.');
    }

    /**
     * Trang quản lý câu hỏi (Admin)
     */
    public function manageQuestions()
    {
        $questions = SurveyQuestion::orderByDesc('id')->paginate(15);
        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Lưu câu hỏi mới (dành cho admin)
     */
    public function storeQuestion(Request $request)
    {
        $validated = $request->validate([
            'question_text' => 'required|string|max:255',
            'question_type' => 'required|string|max:50',
        ], [
            'question_text.required' => 'Vui lòng nhập nội dung câu hỏi.',
            'question_type.required' => 'Vui lòng chọn loại câu hỏi.',
        ]);

        $question = SurveyQuestion::create($validated);

        AdminLog::record(
            'Thêm câu hỏi khảo sát',
            "Câu hỏi mới: '{$question->question_text}' (ID: {$question->id})."
        );

        return back()->with('success', 'Đã thêm câu hỏi khảo sát.');
    }

    /**
     * Xóa câu hỏi khảo sát (admin)
     */
    public function destroyQuestion($id)
    {
        $question = SurveyQuestion::findOrFail($id);
        $text = $question->question_text;
        $question->delete();

        AdminLog::record(
            'Xóa câu hỏi khảo sát',
            "Đã xóa câu hỏi '{$text}' (ID: {$id})."
        );

        return back()->with('success', 'Đã xóa câu hỏi khảo sát.');
    }
}
