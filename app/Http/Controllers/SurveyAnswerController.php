<?php

namespace App\Http\Controllers;

use App\Models\SurveyAnswer;
use Illuminate\Http\Request;

class SurveyAnswerController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $questionId = $request->input('question_id');
        $userId = $request->input('user_id');

        $query = SurveyAnswer::with(['user', 'question']);

        if ($keyword) {
            $query->where('answer', 'like', "%{$keyword}%");
        }

        if ($questionId) {
            $query->where('question_id', $questionId);
        }

        if ($userId) {
            $query->where('user_id', $userId);
        }

        $answers = $query->orderByDesc('id')->paginate(15)->appends($request->all());

        return view('admin.survey_answers.index', compact('answers', 'keyword', 'questionId', 'userId'));
    }

    public function destroy($id)
    {
        $a = SurveyAnswer::findOrFail($id);
        $desc = "User: {$a->user->name} | Q: {$a->question->question_text}";
        $a->delete();

        \App\Models\AdminLog::record('Xóa câu trả lời khảo sát', $desc);

        return back()->with('success', 'Đã xóa câu trả lời.');
    }
}
