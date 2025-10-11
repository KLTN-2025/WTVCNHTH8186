<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AdminLog;

class AuthController extends Controller
{
    public function showRegisterForm() { return view('auth.register'); }
    public function showLoginForm()    { return view('auth.login');    }

    /** Đăng ký tài khoản */
    public function register(Request $request)
    {
        $messages = [
            'name.required' => 'Vui lòng nhập họ tên.',
            'name.max'      => 'Họ tên tối đa 100 ký tự.',
            'email.required'=> 'Vui lòng nhập email.',
            'email.email'   => 'Email không hợp lệ.',
            'email.unique'  => 'Email đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min'      => 'Mật khẩu tối thiểu 6 ký tự.',
            'password.confirmed'=> 'Xác nhận mật khẩu không khớp.',
        ];

        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], $messages);

        $user = User::create([
            'name' => $data['name'],
            'email'=> $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);

        Auth::login($user);

        // --- Ghi log ---
        AdminLog::record(
            'Đăng ký tài khoản',
            "Người dùng {$user->name} (ID: {$user->id}) đã đăng ký tài khoản mới."
        );

        return redirect()->route('home')->with('success', 'Đăng ký thành công.');
    }

    /** Đăng nhập */
    public function login(Request $request)
    {
        $messages = [
            'email.required'=> 'Vui lòng nhập email.',
            'email.email'   => 'Email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ];

        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], $messages);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            // Log thử đăng nhập thất bại (ẩn danh)
            AdminLog::create([
                'admin_id'   => null,
                'user_name'  => 'Khách chưa đăng nhập',
                'action'     => 'Đăng nhập thất bại',
                'description'=> "Email: {$request->email}",
                'ip_address' => $request->ip(),
            ]);

            return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng.'])->withInput();
        }

        $request->session()->regenerate();
        $user = Auth::user();

        // --- Ghi log ---
        AdminLog::record(
            'Đăng nhập hệ thống',
            "{$user->name} (ID: {$user->id}) đã đăng nhập thành công."
        );

        return $user->role === 'admin'
            ? redirect()->route('admin.dashboard')->with('success', 'Đăng nhập quản trị thành công.')
            : redirect()->route('home')->with('success', 'Đăng nhập thành công.');
    }

    /** Đăng xuất */
    public function logout(Request $request)
    {
        $user = Auth::user();

        // --- Ghi log trước khi logout ---
        if ($user) {
            AdminLog::record(
                'Đăng xuất hệ thống',
                "{$user->name} (ID: {$user->id}) đã đăng xuất."
            );
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Đã đăng xuất.');
    }
}
