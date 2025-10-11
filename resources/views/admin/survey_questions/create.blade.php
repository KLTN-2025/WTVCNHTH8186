@extends('layouts.app')

@section('title', 'Thêm câu hỏi khảo sát')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4"><i class="fas fa-plus-circle"></i> Thêm câu hỏi khảo sát mới</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('survey-questions.store') }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="question_text">Nội dung câu hỏi <span class="text-danger">*</span></label>
                    <textarea name="question_text" id="question_text" rows="3"
                              class="form-control @error('question_text') is-invalid @enderror"
                              placeholder="Nhập nội dung câu hỏi...">{{ old('question_text') }}</textarea>
                    @error('question_text')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="type">Loại câu hỏi <span class="text-danger">*</span></label>
                    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                        <option value="">-- Chọn loại câu hỏi --</option>
                        <option value="single" {{ old('type') === 'single' ? 'selected' : '' }}>Một lựa chọn</option>
                        <option value="multiple" {{ old('type') === 'multiple' ? 'selected' : '' }}>Nhiều lựa chọn</option>
                    </select>
                    @error('type')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('survey-questions.index') }}" class="btn btn-secondary">
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
