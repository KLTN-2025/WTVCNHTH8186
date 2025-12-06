<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserAuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLogin()
    {
        if (Auth::check()) return redirect()->route('user.chat');
        return view('user.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('survey.index'));
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng.'])->onlyInput('email');
    }

    // Hiển thị form đăng ký
    public function showRegister()
    {
        if (Auth::check()) return redirect()->route('user.chat');
        return view('user.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);
        return redirect()->route('user.survey');
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

// HIỂN THỊ TRANG PROFILE
    public function profile()
    {
        $user = Auth::user();

        return view('user.profile', compact('user'));
    }

    // CẬP NHẬT PROFILE
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        // VALIDATE
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:6|confirmed',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email'    => 'Email không hợp lệ.',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        // UPDATE BASIC INFO
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // UPDATE PASSWORD WHEN USER ENTER NEW PASSWORD
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'Cập nhật thông tin thành công.');
    }

}
