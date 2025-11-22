@extends('layouts.user')

@section('title', 'Thông tin cá nhân')

@section('content')

<div class="max-w-3xl mx-auto space-y-10">

    {{-- HEADER --}}
    <div class="text-center space-y-2">
        <h1 class="text-3xl font-bold text-primary">Thông tin cá nhân</h1>
        <p class="text-gray-600 dark:text-gray-400">Cập nhật thông tin và mật khẩu tài khoản của bạn.</p>
    </div>

    {{-- FORM --}}
    <form method="POST" action="{{ route('profile.updateSubmit') }}"
          class="bg-white dark:bg-gray-800 rounded-2xl shadow-soft border border-gray-200 dark:border-gray-700 p-8 space-y-8">
        @csrf

        {{-- THÔNG TIN CƠ BẢN --}}
        <h2 class="text-xl font-semibold text-ink dark:text-white">Thông tin chung</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="font-semibold text-sm">Họ và tên</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 px-3 py-2">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="font-semibold text-sm">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 px-3 py-2">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="font-semibold text-sm">Số điện thoại</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                       class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 px-3 py-2">
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- ĐỔI MẬT KHẨU --}}
        <h2 class="text-xl font-semibold text-ink dark:text-white pt-4">Đổi mật khẩu</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="font-semibold text-sm">Mật khẩu mới</label>
                <input type="password" name="password"
                       class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 px-3 py-2"
                       placeholder="Nhập mật khẩu mới">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="font-semibold text-sm">Nhập lại mật khẩu</label>
                <input type="password" name="password_confirmation"
                       class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 px-3 py-2"
                       placeholder="Xác nhận mật khẩu mới">
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- BUTTON --}}
        <div class="pt-4">
            <button
                class="px-6 py-3 font-semibold bg-primary text-white rounded-xl shadow hover:bg-primary-600 transition">
                Lưu thay đổi
            </button>
        </div>

    </form>

</div>

@endsection
