<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;
use App\Models\AdminLog;

class UniversityController extends Controller
{
    /**
     * Danh sách trường đại học (có tìm kiếm + phân trang)
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $sort = $request->input('sort', 'desc');
        $perPage = 10;

        $query = University::query();

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('location', 'LIKE', "%{$keyword}%")
                  ->orWhere('website', 'LIKE', "%{$keyword}%");
            });
        }

        $query->orderBy('id', $sort);
        $universities = $query->paginate($perPage)->appends($request->all());

        return view('admin.universities.index', compact('universities', 'keyword', 'sort'));
    }

    /**
     * Form thêm trường
     */
    public function create()
    {
        return view('admin.universities.create');
    }

    /**
     * Lưu trường đại học mới
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required'     => 'Vui lòng nhập tên trường.',
            'name.max'          => 'Tên trường tối đa 200 ký tự.',
            'location.required' => 'Vui lòng nhập địa điểm.',
            'location.max'      => 'Địa điểm tối đa 200 ký tự.',
            'website.url'       => 'Website không hợp lệ.',
            'ranking.integer'   => 'Thứ hạng phải là số nguyên.',
            'ranking.min'       => 'Thứ hạng phải >= 1.',
        ];

        $data = $request->validate([
            'name'     => 'required|string|max:200',
            'location' => 'required|string|max:200',
            'website'  => 'nullable|url|max:255',
            'ranking'  => 'nullable|integer|min:1',
        ], $messages);

        $uni = University::create($data);

        // ✅ Ghi log hành động
        AdminLog::record(
            'Thêm trường đại học',
            "Trường '{$uni->name}' (ID: {$uni->id}) đã được thêm mới."
        );

        return redirect()->route('universities.index')->with('success', 'Thêm trường thành công.');
    }

    /**
     * Form chỉnh sửa trường
     */
    public function edit($id)
    {
        $university = University::findOrFail($id);
        return view('admin.universities.edit', compact('university'));
    }

    /**
     * Cập nhật thông tin trường
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'name.required'     => 'Vui lòng nhập tên trường.',
            'name.max'          => 'Tên trường tối đa 200 ký tự.',
            'location.required' => 'Vui lòng nhập địa điểm.',
            'location.max'      => 'Địa điểm tối đa 200 ký tự.',
            'website.url'       => 'Website không hợp lệ.',
            'ranking.integer'   => 'Thứ hạng phải là số nguyên.',
            'ranking.min'       => 'Thứ hạng phải >= 1.',
        ];

        $data = $request->validate([
            'name'     => 'required|string|max:200',
            'location' => 'required|string|max:200',
            'website'  => 'nullable|url|max:255',
            'ranking'  => 'nullable|integer|min:1',
        ], $messages);

        $uni = University::findOrFail($id);
        $uni->update($data);

        // ✅ Ghi log hành động
        AdminLog::record(
            'Cập nhật trường đại học',
            "Thông tin trường '{$uni->name}' (ID: {$uni->id}) đã được chỉnh sửa."
        );

        return redirect()->back()->with('success', 'Cập nhật thành công.');
    }

    /**
     * Xóa trường đại học
     */
    public function destroy($id)
    {
        $uni = University::findOrFail($id);
        $name = $uni->name;
        $uni->delete();

        // ✅ Ghi log hành động
        AdminLog::record(
            'Xóa trường đại học',
            "Trường '{$name}' (ID: {$id}) đã bị xóa khỏi hệ thống."
        );

        return redirect()->back()->with('success', 'Đã xóa trường.');
    }
}
