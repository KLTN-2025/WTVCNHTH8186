<?php

namespace App\Http\Controllers;

use App\Models\SurveyQuestion;
use App\Models\AdminLog;
use Illuminate\Http\Request;

class SurveyQuestionController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type', 'all');

        $query = SurveyQuestion::query();

        if ($keyword) {
            $query->where('question_text', 'like', "%{$keyword}%");
        }

        if ($type !== 'all') {
            $query->where('type', $type);
        }

        $questions = $query->orderByDesc('id')->paginate(10)->appends($request->all());

        return view('admin.survey_questions.index', compact('questions', 'keyword', 'type'));
    }

    public function create()
    {
        return view('admin.survey_questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required|string|max:255',
            'type' => 'required|in:single,multiple',
        ], [
            'question_text.required' => 'Vui lòng nhập nội dung câu hỏi.',
            'type.required' => 'Vui lòng chọn loại câu hỏi.',
            'type.in' => 'Loại câu hỏi không hợp lệ.'
        ]);

        $q = SurveyQuestion::create($request->only('question_text', 'type'));
        AdminLog::record('Thêm câu hỏi khảo sát', $q->question_text);

        return redirect()->route('survey-questions.index')->with('success', 'Thêm câu hỏi thành công.');
    }

    public function edit($id)
    {
        $question = SurveyQuestion::findOrFail($id);
        return view('admin.survey_questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question_text' => 'required|string|max:255',
            'type' => 'required|in:single,multiple',
        ], [
            'question_text.required' => 'Vui lòng nhập nội dung câu hỏi.',
            'type.required' => 'Vui lòng chọn loại câu hỏi.',
            'type.in' => 'Loại câu hỏi không hợp lệ.'
        ]);

        $q = SurveyQuestion::findOrFail($id);
        $q->update($request->only('question_text', 'type'));

        AdminLog::record('Cập nhật câu hỏi khảo sát', $q->question_text);

        return redirect()->route('survey-questions.index')->with('success', 'Cập nhật thành công.');
    }

    public function destroy($id)
    {
        $q = SurveyQuestion::findOrFail($id);
        AdminLog::record('Xóa câu hỏi khảo sát', $q->question_text);
        $q->delete();

        return back()->with('success', 'Đã xóa câu hỏi.');
    }
}
