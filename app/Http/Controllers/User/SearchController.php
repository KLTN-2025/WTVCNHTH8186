<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\University;
use App\Models\SurveyQuestion;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = trim($request->input('q'));

        if ($q === '') {
            return back();
        }

        // Tìm Major theo tên + mô tả
        $majors = Major::where('name', 'LIKE', "%$q%")
            ->orWhere('description', 'LIKE', "%$q%")
            ->limit(20)
            ->get();

        // Tìm University theo tên + địa điểm
        $universities = University::where('name', 'LIKE', "%$q%")
            ->orWhere('location', 'LIKE', "%$q%")
            ->limit(20)
            ->get();

        // Tìm Survey Question
        $questions = SurveyQuestion::where('question_text', 'LIKE', "%$q%")
            ->limit(20)
            ->get();

        return view('user.search', [
            'q' => $q,
            'majors' => $majors,
            'universities' => $universities,
            'questions' => $questions,
        ]);
    }

}
