@extends('layouts.app')

@section('title', 'Liên kết ngành – trường')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4"><i class="fas fa-link"></i> Danh sách liên kết ngành – trường</h4>

    {{-- Bộ lọc --}}
    <form method="GET" action="{{ route('major-university.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-2 mb-2">
                <input type="text" name="keyword" value="{{ $keyword ?? '' }}" class="form-control"
                       placeholder="Tìm theo tên ngành hoặc trường...">
            </div>

            <div class="col-md-2 mb-2">
                <select name="major_id" class="form-control">
                    <option value="">-- Chọn ngành học --</option>
                    @foreach($majors as $m)
                        <option value="{{ $m->id }}" {{ (request('major_id') == $m->id) ? 'selected' : '' }}>
                            {{ $m->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 mb-2">
                <select name="university_id" class="form-control">
                    <option value="">-- Chọn trường đại học --</option>
                    @foreach($universities as $u)
                        <option value="{{ $u->id }}" {{ (request('university_id') == $u->id) ? 'selected' : '' }}>
                            {{ $u->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 mb-2">
                <button class="btn btn-primary w-100"><i class="fas fa-search"></i> Tìm Kiếm</button>
            </div>
            <div class="col-md-2 mb-2">
                <a href="{{ route('major-university.index') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-undo"></i> Làm mới
                </a>
            </div>
            <div class="col-md-2 mb-2">
                <a href="{{ route('major-university.create') }}" class="btn btn-primary w-100">
                    <i class="fas fa-plus"></i> Thêm mới
                </a>
            </div>
        </div>
    </form>

    {{-- Bảng dữ liệu --}}
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Ngành học</th>
                        <th>Trường đại học</th>
                        <th>Học phí (VNĐ)</th>
                        <th>Thời gian (năm)</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $r)
                        <tr>
                            <td>{{ $records->firstItem() + $loop->index }}</td>
                            <td>{{ $r->major->name ?? '---' }}</td>
                            <td>{{ $r->university->name ?? '---' }}</td>
                            <td>{{ number_format($r->tuition_fee ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $r->duration_years ?? '---' }}</td>
                            <td>
                                <a href="{{ route('major-university.edit', $r->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('major-university.destroy', $r->id) }}"
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Xóa liên kết này?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-3">Không có dữ liệu.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer text-right">
            {{ $records->links('pagination::bootstrap-4') }}
        </div>
    </div>

</div>
@endsection
