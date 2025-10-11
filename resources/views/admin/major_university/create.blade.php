@extends('layouts.app')

@section('title', 'Thêm liên kết ngành – trường')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4"><i class="fas fa-plus-circle"></i> Thêm liên kết ngành – trường mới</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('major-university.store') }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="major_id">Ngành học <span class="text-danger">*</span></label>
                    <select name="major_id" id="major_id" class="form-control @error('major_id') is-invalid @enderror" required>
                        <option value="">-- Chọn ngành học --</option>
                        @foreach($majors as $m)
                            <option value="{{ $m->id }}" {{ old('major_id') == $m->id ? 'selected' : '' }}>
                                {{ $m->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('major_id')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="university_id">Trường đại học <span class="text-danger">*</span></label>
                    <select name="university_id" id="university_id"
                            class="form-control @error('university_id') is-invalid @enderror" required>
                        <option value="">-- Chọn trường đại học --</option>
                        @foreach($universities as $u)
                            <option value="{{ $u->id }}" {{ old('university_id') == $u->id ? 'selected' : '' }}>
                                {{ $u->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('university_id')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="tuition_fee">Học phí trung bình (VNĐ)</label>
                    <input type="number" name="tuition_fee" id="tuition_fee" class="form-control"
                           value="{{ old('tuition_fee') }}" placeholder="Nhập học phí trung bình">
                    @error('tuition_fee')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="duration_years">Thời gian đào tạo (năm)</label>
                    <input type="number" name="duration_years" id="duration_years" class="form-control"
                           value="{{ old('duration_years') }}" placeholder="Nhập số năm đào tạo">
                    @error('duration_years')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('major-university.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu liên kết
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
