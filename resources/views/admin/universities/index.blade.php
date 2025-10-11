@extends('layouts.app')

@section('title', 'Quản lý trường đại học')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4"><i class="fas fa-university"></i> Danh sách trường đại học</h4>

    {{-- Thanh tìm kiếm --}}
    <form method="GET" action="{{ route('universities.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4 mb-2">
                <input type="text" name="keyword" class="form-control"
                       placeholder="Tìm theo tên, địa điểm hoặc website..."
                       value="{{ $keyword ?? '' }}">
            </div>
            <div class="col-md-2 mb-2">
                <select name="sort" class="form-control" onchange="this.form.submit()">
                    <option value="desc" {{ $sort == 'desc' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="asc" {{ $sort == 'asc' ? 'selected' : '' }}>Cũ nhất</option>
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <button class="btn btn-primary w-100"><i class="fas fa-search"></i> Tìm kiếm</button>
            </div>
            <div class="col-md-2 mb-2">
                <a href="{{ route('universities.index') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-undo"></i> Làm mới
                </a>
            </div>
            <div class="col-md-2 mb-2">
                <a href="{{ route('universities.create') }}" class="btn btn-primary w-100">
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
                        <th>Tên trường</th>
                        <th>Địa điểm</th>
                        <th>Website</th>
                        <th>Xếp hạng</th>
                        <th width="15%" class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($universities as $university)
                        <tr>
                            <td>{{ $universities->firstItem() + $loop->index }}</td>
                            <td>{{ $university->name }}</td>
                            <td>{{ $university->location }}</td>
                            <td>
                                @if($university->website)
                                    <a href="{{ $university->website }}" target="_blank">{{ $university->website }}</a>
                                @else
                                    <span class="text-muted">Chưa cập nhật</span>
                                @endif
                            </td>
                            <td>{{ $university->ranking ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('universities.edit', $university->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('universities.destroy', $university->id) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa trường này?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">Không tìm thấy trường nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer text-right">
            {{ $universities->links('pagination::bootstrap-4') }}
        </div>
    </div>

</div>
@endsection
