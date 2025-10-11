@extends('layouts.app')

@section('title', 'Chỉnh sửa liên kết ngành – trường')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4"><i class="fas fa-edit"></i> Chỉnh sửa liên kết ngành – trường</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('major-university.update', $record->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="major_id">Ngành học <span class="text-danger">*</span></label>
                    <select name="major_id" id="major_id" class="form-control" required>
                        @foreach($majors as $m)
                            <option value="{{ $m->id }}" {{ $record->major_id == $m->id ? 'selected' : '' }}>
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
                    <select name="university_id" id="university_id" class="form-control" required>
                        @foreach($universities as $u)
                            <option value="{{ $u->id }}" {{ $record->university_id == $u->id ? 'selected' : '' }}>
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
                           value="{{ old('tuition_fee', $record->tuition_fee) }}">
                    @error('tuition_fee')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="duration_years">Thời gian đào tạo (năm)</label>
                    <input type="number" name="duration_years" id="duration_years" class="form-control"
                           value="{{ old('duration_years', $record->duration_years) }}">
                    @error('duration_years')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('major-university.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
