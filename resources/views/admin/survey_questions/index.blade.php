@extends('layouts.app')

@section('title', 'Danh sách câu hỏi khảo sát')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4"><i class="fas fa-question-circle"></i> Danh sách câu hỏi khảo sát</h4>

    {{-- Form tìm kiếm --}}
    <form method="GET" action="{{ route('survey-questions.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-3 mb-2">
                <input type="text" name="keyword" value="{{ $keyword ?? '' }}" class="form-control"
                       placeholder="Tìm theo nội dung câu hỏi...">
            </div>
            <div class="col-md-3 mb-2">
                <select name="type" class="form-control">
                    <option value="all" {{ ($type ?? '') === 'all' ? 'selected' : '' }}>-- Loại câu hỏi --</option>
                    <option value="single" {{ ($type ?? '') === 'single' ? 'selected' : '' }}>Trắc nghiệm 1 lựa chọn</option>
                    <option value="multiple" {{ ($type ?? '') === 'multiple' ? 'selected' : '' }}>Trắc nghiệm nhiều lựa chọn</option>
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <button class="btn btn-primary w-100"><i class="fas fa-search"></i> Tìm kiếm</button>
            </div>
            <div class="col-md-2 mb-2">
                <a href="{{ route('survey-questions.index') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-undo"></i> Làm mới
                </a>
            </div>
            <div class="col-md-2 mb-2">
                <a href="{{ route('survey-questions.create') }}" class="btn btn-primary w-100">
                    <i class="fas fa-plus-circle"></i> Thêm mới
                </a>
            </div>
        </div>
    </form>

    {{-- Bảng câu hỏi --}}
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Nội dung câu hỏi</th>
                        <th width="20%">Loại</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($questions as $q)
                        <tr>
                            <td>{{ $questions->firstItem() + $loop->index }}</td>
                            <td>{{ $q->question_text }}</td>
                            <td>
                                @if($q->type === 'single')
                                    <span class="badge bg-primary">Một lựa chọn</span>
                                @else
                                    <span class="badge bg-info text-dark">Nhiều lựa chọn</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('survey-questions.edit', $q->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('survey-questions.destroy', $q->id) }}" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa câu hỏi này?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-3">Không có câu hỏi nào.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer text-right">
            {{ $questions->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>
@endsection
