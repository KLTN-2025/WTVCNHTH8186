<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdminLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Danh sách người dùng
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $status = $request->input('status', 'all'); // all | active | blocked

        $query = User::query()->where('role', 'user');

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if ($status === 'active') {
            $query->where('is_blocked', false);
        } elseif ($status === 'blocked') {
            $query->where('is_blocked', true);
        }

        $users = $query->orderByDesc('id')->paginate(10)->appends($request->all());

        return view('admin.users.index', compact('users', 'keyword', 'status'));
    }

    /**
     * Form thêm người dùng
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Lưu người dùng mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'Tên người dùng không được bỏ trống.',
            'email.required' => 'Email không được bỏ trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email này đã tồn tại.',
            'password.required' => 'Mật khẩu không được bỏ trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'is_blocked' => false,
        ]);

        // ✅ Ghi log
        AdminLog::record(
            'Thêm người dùng',
            "Người dùng '{$user->name}' (ID: {$user->id}, Email: {$user->email}) đã được thêm mới."
        );

        return redirect()->route('users.index')->with('success', 'Thêm người dùng mới thành công!');
    }

    /**
     * Form chỉnh sửa
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Cập nhật thông tin người dùng
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|min:6|confirmed',
        ], [
            'name.required' => 'Tên người dùng không được bỏ trống.',
            'email.required' => 'Email không được bỏ trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email này đã tồn tại.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.'
        ]);

        $data = $request->only('name', 'email');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // ✅ Ghi log
        AdminLog::record(
            'Cập nhật người dùng',
            "Thông tin người dùng '{$user->name}' (ID: {$user->id}) đã được cập nhật."
        );

        return redirect()->route('users.index')->with('success', 'Cập nhật thông tin người dùng thành công!');
    }

    /**
     * Xóa người dùng
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $name = $user->name;
        $email = $user->email;
        $user->delete();

        // ✅ Ghi log
        AdminLog::record(
            'Xóa người dùng',
            "Tài khoản '{$name}' (Email: {$email}) đã bị xóa khỏi hệ thống."
        );

        return redirect()->route('users.index')->with('success', 'Xóa người dùng thành công!');
    }

    /**
     * Chặn hoặc mở chặn người dùng
     */
    public function toggleBlock($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = !$user->is_blocked;
        $user->save();

        $status = $user->is_blocked ? 'bị chặn' : 'được mở khóa';

        // ✅ Ghi log
        AdminLog::record(
            'Cập nhật trạng thái tài khoản',
            "Người dùng '{$user->name}' (ID: {$user->id}) đã {$status}."
        );

        return redirect()->route('users.index')->with('success', "Người dùng {$user->name} {$status}.");
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.users.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $messages = [
            'name.required' => 'Vui lòng nhập họ tên.',
            'name.max' => 'Họ tên không được vượt quá 100 ký tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Email này đã được sử dụng.',
            'password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại để xác nhận thay đổi.',
        ];

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:6|confirmed',
        ], $messages);

        $hasPasswordChange = $request->filled('password');

        if ($hasPasswordChange) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác.'])->withInput();
            }
            $user->password = Hash::make($request->password);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // ✅ Ghi log
        if ($hasPasswordChange) {
            AdminLog::record(
                'Cập nhật hồ sơ cá nhân',
                "Người dùng '{$user->name}' (ID: {$user->id}) đã cập nhật thông tin và đổi mật khẩu."
            );
        } else {
            AdminLog::record(
                'Cập nhật hồ sơ cá nhân',
                "Người dùng '{$user->name}' (ID: {$user->id}) đã cập nhật thông tin cá nhân."
            );
        }

        return back()->with('success', 'Cập nhật thông tin cá nhân thành công.');
    }
}
