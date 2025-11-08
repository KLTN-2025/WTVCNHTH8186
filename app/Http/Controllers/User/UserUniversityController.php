<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Major;

class UserUniversityController extends Controller
{
    public function index(Request $request)
    {
        $query = University::query()->with(['majors']);

        // Lọc theo tên hoặc địa điểm
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($qB) use ($q) {
                $qB->where('name', 'LIKE', "%$q%")
                   ->orWhere('location', 'LIKE', "%$q%");
            });
        }

        // Lọc theo ngành học
        if ($request->filled('major_id')) {
            $majorId = $request->major_id;
            $query->whereHas('majors', function($q) use ($majorId) {
                $q->where('majors.id', $majorId);
            });
        }

        $universities = $query->orderBy('ranking', 'asc')->paginate(9);
        $majors = Major::orderBy('name')->get();

        return view('user.universities', compact('universities', 'majors'));
    }
}
