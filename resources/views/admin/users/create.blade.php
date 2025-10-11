@extends('layouts.app')

@section('title', 'Thêm người dùng mới')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4"><i class="fas fa-user-plus"></i> Thêm người dùng mới</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                {{-- Tên người dùng --}}
                <div class="form-group mb-3">
                    <label for="name">Tên người dùng <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name"
                           value="{{ old('name') }}"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Nhập họ tên" required>
                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group mb-3">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email"
                           value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="Nhập email" required>
                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Mật khẩu --}}
                <div class="form-group mb-3">
                    <label for="password">Mật khẩu <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Nhập mật khẩu" required>
                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Xác nhận mật khẩu --}}
                <div class="form-group mb-3">
                    <label for="password_confirmation">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           placeholder="Nhập lại mật khẩu" required>
                    @error('password_confirmation')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Nút điều hướng --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu thông tin
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
