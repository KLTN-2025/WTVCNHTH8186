@extends('layouts.app')

@section('title', 'Quản lý ngành học')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4"><i class="fas fa-book"></i> Danh sách ngành học</h4>

    {{-- Thanh tìm kiếm --}}
    <form method="GET" action="{{ route('majors.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4 mb-2">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên, mô tả hoặc cơ hội nghề nghiệp..."
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
                <a href="{{ route('majors.index') }}" class="btn btn-secondary w-100"><i class="fas fa-undo"></i> Làm mới</a>
            </div>
            <div class="col-md-2 mb-2 text-right">
                <a href="{{ route('majors.create') }}" class="btn btn-primary w-100"><i class="fas fa-plus"></i> Thêm mới</a>
            </div>
        </div>
    </form>

    {{-- Bảng danh sách --}}
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Tên ngành</th>
                        <th width="25%">Yêu cầu đầu vào</th>
                        <th width="25%">Cơ hội nghề nghiệp</th>
                        <th width="15%" class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($majors as $major)
                        <tr>
                            <td>{{ $majors->firstItem() + $loop->index }}</td>
                            <td>{{ $major->name }}</td>
                            <td>{{ Str::limit($major->requirements, 80) }}</td>
                            <td>{{ Str::limit($major->career_opportunities, 80) }}</td>
                            <td class="text-center">
                                <a href="{{ route('majors.edit', $major->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('majors.destroy', $major->id) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa ngành học này?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">Không tìm thấy ngành học nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer text-right">
            {{ $majors->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>
@endsection
