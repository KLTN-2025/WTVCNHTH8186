@extends('layouts.app')

@section('title', 'Cập nhật hồ sơ cá nhân')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4"><i class="fas fa-user-circle"></i> Cập nhật hồ sơ cá nhân</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                {{-- Họ tên --}}
                <div class="form-group mb-3">
                    <label for="name">Họ và tên <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name"
                           value="{{ old('name', $user->name) }}"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Nhập họ và tên của bạn" required>
                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group mb-3">
                    <label for="email">Địa chỉ Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email"
                           value="{{ old('email', $user->email) }}"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="Nhập email của bạn" required>
                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <hr>
                <h6 class="text-primary mb-3">
                    <i class="fas fa-lock"></i> Đổi mật khẩu (tuỳ chọn)
                </h6>

                {{-- Mật khẩu hiện tại --}}
                <div class="form-group mb-3">
                    <label for="current_password">Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" id="current_password"
                           class="form-control @error('current_password') is-invalid @enderror"
                           placeholder="Nhập mật khẩu hiện tại nếu muốn đổi mật khẩu">
                    @error('current_password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Mật khẩu mới --}}
                <div class="form-group mb-3">
                    <label for="password">Mật khẩu mới</label>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Nhập mật khẩu mới (tối thiểu 6 ký tự)">
                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Xác nhận mật khẩu --}}
                <div class="form-group mb-4">
                    <label for="password_confirmation">Xác nhận mật khẩu mới</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-control" placeholder="Nhập lại mật khẩu mới">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
