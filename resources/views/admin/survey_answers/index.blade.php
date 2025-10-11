@extends('layouts.app')

@section('title', 'Câu trả lời khảo sát')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4"><i class="fas fa-list-ul"></i> Danh sách câu trả lời khảo sát</h4>

    {{-- Form lọc và tìm kiếm --}}
    <form method="GET" action="{{ route('survey-answers.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4 mb-2">
                <input type="text" name="keyword" value="{{ $keyword ?? '' }}" class="form-control"
                       placeholder="Tìm theo nội dung câu trả lời...">
            </div>
            <div class="col-md-3 mb-2">
                <select name="question_id" class="form-control">
                    <option value="">-- Chọn câu hỏi --</option>
                    @php
                        $questionsList = \App\Models\SurveyQuestion::orderBy('id')->get();
                    @endphp
                    @foreach($questionsList as $q)
                        <option value="{{ $q->id }}" {{ (request('question_id') == $q->id) ? 'selected' : '' }}>
                            {{ $q->question_text }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-2">
                <select name="user_id" class="form-control">
                    <option value="">-- Chọn người dùng --</option>
                    @php
                        $usersList = \App\Models\User::where('role', 'user')->orderBy('name')->get();
                    @endphp
                    @foreach($usersList as $u)
                        <option value="{{ $u->id }}" {{ (request('user_id') == $u->id) ? 'selected' : '' }}>
                            {{ $u->name }} ({{ $u->email }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <button class="btn btn-primary w-100"><i class="fas fa-search"></i> Tìm kiếm</button>
            </div>
        </div>
    </form>

    {{-- Bảng câu trả lời --}}
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Người dùng</th>
                        <th>Câu hỏi</th>
                        <th>Nội dung trả lời</th>
                        <th width="20%">Thời gian</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($answers as $a)
                        <tr>
                            <td>{{ $answers->firstItem() + $loop->index }}</td>
                            <td>
                                {{ $a->user->name ?? 'Không xác định' }}<br>
                                <small class="text-muted">{{ $a->user->email ?? '' }}</small>
                            </td>
                            <td>{{ $a->question->question_text ?? '---' }}</td>
                            <td>{{ $a->answer }}</td>
                            <td>{{ $a->created_at?->format('d/m/Y H:i') }}</td>
                            <td>
                                <form method="POST" action="{{ route('survey-answers.destroy', $a->id) }}"
                                      onsubmit="return confirm('Bạn có chắc muốn xóa câu trả lời này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">Không có câu trả lời nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer text-right">
            {{ $answers->links('pagination::bootstrap-4') }}
        </div>
    </div>

</div>
@endsection
