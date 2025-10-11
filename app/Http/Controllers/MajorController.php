<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\AdminLog;
use Illuminate\Support\Facades\Auth;

class MajorController extends Controller
{
    /**
     * Hiển thị danh sách ngành học
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $sort = $request->input('sort', 'desc');
        $perPage = 10;

        $query = Major::query();

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('description', 'LIKE', "%{$keyword}%")
                    ->orWhere('career_opportunities', 'LIKE', "%{$keyword}%");
            });
        }

        $query->orderBy('id', $sort);
        $majors = $query->paginate($perPage)->appends($request->all());

        // Ghi log xem danh sách (tuỳ chọn)
        return view('admin.majors.index', compact('majors', 'keyword', 'sort'));
    }

    /**
     * Hiển thị form thêm ngành học
     */
    public function create()
    {
        return view('admin.majors.create');
    }

    /**
     * Lưu ngành học mới
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Vui lòng nhập tên ngành học.',
            'name.max' => 'Tên ngành học không được vượt quá 150 ký tự.',
            'description.string' => 'Mô tả ngành học phải là chuỗi ký tự.',
            'requirements.string' => 'Yêu cầu đầu vào phải là chuỗi ký tự.',
            'career_opportunities.string' => 'Cơ hội nghề nghiệp phải là chuỗi ký tự.'
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'career_opportunities' => 'nullable|string',
        ], $messages);

        $major = Major::create($validated);

        AdminLog::record(
            'Thêm ngành học',
            "Ngành học '{$major->name}' (ID: {$major->id}) đã được thêm mới."
        );

        return redirect()->route('majors.index')->with('success', 'Thêm ngành học thành công.');
    }

    /**
     * Hiển thị form sửa ngành học
     */
    public function edit($id)
    {
        $major = Major::findOrFail($id);

        return view('admin.majors.edit', compact('major'));
    }

    /**
     * Cập nhật ngành học
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'name.required' => 'Vui lòng nhập tên ngành học.',
            'name.max' => 'Tên ngành học không được vượt quá 150 ký tự.',
            'description.string' => 'Mô tả ngành học phải là chuỗi ký tự.',
            'requirements.string' => 'Yêu cầu đầu vào phải là chuỗi ký tự.',
            'career_opportunities.string' => 'Cơ hội nghề nghiệp phải là chuỗi ký tự.'
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'career_opportunities' => 'nullable|string',
        ], $messages);

        $major = Major::findOrFail($id);
        $major->update($validated);

        AdminLog::record(
            'Cập nhật ngành học',
            "Ngành học '{$major->name}' (ID: {$major->id}) đã được chỉnh sửa."
        );

        return redirect()->back()->with('success', 'Cập nhật ngành học thành công.');
    }

    /**
     * Xóa ngành học
     */
    public function destroy($id)
    {
        $major = Major::findOrFail($id);
        $name = $major->name;
        $major->delete();

        AdminLog::record(
            'Xóa ngành học',
            "Ngành học '{$name}' (ID: {$id}) đã bị xóa."
        );

        return redirect()->back()->with('success', 'Đã xóa ngành học thành công.');
    }

    /**
     * Xem chi tiết ngành học
     */
    public function show($id)
    {
        $major = Major::findOrFail($id);

        AdminLog::record(
            'Xem chi tiết ngành học',
            "Ngành học: {$major->name} (ID: {$major->id})"
        );

        return view('admin.majors.show', compact('major'));
    }
}
