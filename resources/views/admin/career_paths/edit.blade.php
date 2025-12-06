@extends('layouts.app')

@section('title', 'Chỉnh sửa lộ trình nghề nghiệp')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4"><i class="fas fa-edit"></i> Chỉnh sửa lộ trình nghề nghiệp</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST" action="{{ route('career-paths.update', $path->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="major_id">Ngành học <span class="text-danger">*</span></label>
                    <select name="major_id" id="major_id" class="form-control @error('major_id') is-invalid @enderror" required>
                        @foreach($majors as $m)
                            <option value="{{ $m->id }}" {{ $path->major_id == $m->id ? 'selected' : '' }}>
                                {{ $m->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('major_id')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="title">Tiêu đề lộ trình <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $path->title) }}" required>
                    @error('title')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="description">Mô tả</label>
                    <textarea name="description" id="description" rows="4"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $path->description) }}</textarea>
                    @error('description')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="average_salary">Lương trung bình (VNĐ)</label>
                    <input type="number" name="average_salary" id="average_salary"
                           class="form-control @error('average_salary') is-invalid @enderror"
                           value="{{ old('average_salary', $path->average_salary) }}">
                    @error('average_salary')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('career-paths.index') }}" class="btn btn-secondary">
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
