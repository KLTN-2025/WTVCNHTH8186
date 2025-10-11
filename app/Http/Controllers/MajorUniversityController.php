<?php

namespace App\Http\Controllers;

use App\Models\MajorUniversity;
use App\Models\Major;
use App\Models\University;
use App\Models\AdminLog;
use Illuminate\Http\Request;

class MajorUniversityController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $major = $request->input('major_id');
        $university = $request->input('university_id');

        $query = MajorUniversity::with(['major', 'university']);

        if ($keyword) {
            $query->whereHas('major', fn($q) => $q->where('name', 'like', "%{$keyword}%"))
                  ->orWhereHas('university', fn($q) => $q->where('name', 'like', "%{$keyword}%"));
        }

        if ($major) $query->where('major_id', $major);
        if ($university) $query->where('university_id', $university);

        $records = $query->orderByDesc('id')->paginate(10)->appends($request->all());

        $majors = Major::all();
        $universities = University::all();

        return view('admin.major_university.index', compact('records', 'majors', 'universities', 'keyword', 'major', 'university'));
    }

    public function create()
    {
        $majors = Major::all();
        $universities = University::all();
        return view('admin.major_university.create', compact('majors', 'universities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'major_id' => 'required|exists:majors,id',
            'university_id' => 'required|exists:universities,id',
            'tuition_fee' => 'nullable|numeric|min:0',
            'duration_years' => 'nullable|integer|min:1',
        ], [
            'major_id.required' => 'Vui lòng chọn ngành học.',
            'university_id.required' => 'Vui lòng chọn trường đại học.',
            'tuition_fee.numeric' => 'Học phí phải là một số.',
            'duration_years.integer' => 'Thời gian học phải là một số nguyên.',
            'duration_years.min' => 'Thời gian học phải ít nhất 1 năm.'
        ]);

        $r = MajorUniversity::create($request->all());
        AdminLog::record('Thêm liên kết ngành–trường', "{$r->major->name} – {$r->university->name}");

        return redirect()->route('major-university.index')->with('success', 'Thêm liên kết thành công.');
    }

    public function edit($id)
    {
        $record = MajorUniversity::findOrFail($id);
        $majors = Major::all();
        $universities = University::all();
        return view('admin.major_university.edit', compact('record', 'majors', 'universities'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'major_id' => 'required|exists:majors,id',
            'university_id' => 'required|exists:universities,id',
            'tuition_fee' => 'nullable|numeric|min:0',
            'duration_years' => 'nullable|integer|min:1',
        ], [
            'major_id.required' => 'Vui lòng chọn ngành học.',
            'university_id.required' => 'Vui lòng chọn trường đại học.',
            'tuition_fee.numeric' => 'Học phí phải là một số.',
            'duration_years.integer' => 'Thời gian học phải là một số nguyên.',
            'duration_years.min' => 'Thời gian học phải ít nhất 1 năm.'
        ]);

        $r = MajorUniversity::findOrFail($id);
        $r->update($request->all());

        AdminLog::record('Cập nhật liên kết ngành–trường', "{$r->major->name} – {$r->university->name}");

        return redirect()->route('major-university.index')->with('success', 'Cập nhật thành công.');
    }

    public function destroy($id)
    {
        $r = MajorUniversity::findOrFail($id);
        $desc = "{$r->major->name} – {$r->university->name}";
        $r->delete();

        AdminLog::record('Xóa liên kết ngành–trường', $desc);

        return back()->with('success', 'Đã xóa liên kết.');
    }
}
