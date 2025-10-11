<?php

namespace App\Http\Controllers;

use App\Models\CareerPath;
use App\Models\Major;
use App\Models\AdminLog;
use Illuminate\Http\Request;

class CareerPathController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $major = $request->input('major_id');

        $query = CareerPath::with('major');

        if ($keyword) {
            $query->where('title', 'like', "%{$keyword}%");
        }

        if ($major) {
            $query->where('major_id', $major);
        }

        $paths = $query->orderByDesc('id')->paginate(10)->appends($request->all());
        $majors = Major::all();

        return view('admin.career_paths.index', compact('paths', 'keyword', 'major', 'majors'));
    }

    public function create()
    {
        $majors = Major::all();
        return view('admin.career_paths.create', compact('majors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'major_id' => 'required|exists:majors,id',
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'average_salary' => 'nullable|numeric|min:0',
        ], [
            'major_id.required' => 'Vui lòng chọn ngành học.',
            'title.required' => 'Vui lòng nhập tiêu đề lộ trình.',
        ]);

        $p = CareerPath::create($request->all());
        AdminLog::record('Thêm lộ trình nghề nghiệp', $p->title);

        return redirect()->route('career-paths.index')->with('success', 'Thêm thành công.');
    }

    public function edit($id)
    {
        $path = CareerPath::findOrFail($id);
        $majors = Major::all();
        return view('admin.career_paths.edit', compact('path', 'majors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'major_id' => 'required|exists:majors,id',
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'average_salary' => 'nullable|numeric|min:0',
        ]);

        $p = CareerPath::findOrFail($id);
        $p->update($request->all());

        AdminLog::record('Cập nhật lộ trình nghề nghiệp', $p->title);

        return redirect()->route('career-paths.index')->with('success', 'Cập nhật thành công.');
    }

    public function destroy($id)
    {
        $p = CareerPath::findOrFail($id);
        AdminLog::record('Xóa lộ trình nghề nghiệp', $p->title);
        $p->delete();

        return back()->with('success', 'Đã xóa lộ trình.');
    }
}
