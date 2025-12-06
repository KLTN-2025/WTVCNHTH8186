@extends('layouts.app')

@section('title', 'Lộ trình nghề nghiệp')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4"><i class="fas fa-route"></i> Danh sách lộ trình nghề nghiệp</h4>

    {{-- Bộ lọc --}}
    <form method="GET" action="{{ route('career-paths.index') }}" class="mb-3">
        <div class="row">

            <div class="col-md-3 mb-2">
                <input type="text" name="keyword" value="{{ $keyword ?? '' }}" class="form-control"
                       placeholder="Tìm theo tiêu đề...">
            </div>

            <div class="col-md-3 mb-2">
                <select name="major" class="form-control">
                    <option value="">-- Chọn ngành học --</option>
                    @foreach($majors as $m)
                        <option value="{{ $m->id }}" {{ (request('major') == $m->id) ? 'selected' : '' }}>
                            {{ $m->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 mb-2">
                <button class="btn btn-primary w-100"><i class="fas fa-search"></i> Tìm kiếm</button>
            </div>

            <div class="col-md-2 mb-2">
                <a href="{{ route('career-paths.index') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-undo"></i> Làm mới
                </a>
            </div>

            <div class="col-md-2 mb-2">
                <a href="{{ route('career-paths.create') }}" class="btn btn-primary w-100">
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
                        <th>Tiêu đề</th>
                        <th>Ngành học</th>
                        <th>Lương trung bình (VNĐ)</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paths as $p)
                        <tr>
                            <td>{{ $paths->firstItem() + $loop->index }}</td>
                            <td>{{ $p->title }}</td>
                            <td>{{ $p->major->name ?? '---' }}</td>
                            <td>{{ number_format($p->average_salary ?? 0, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('career-paths.edit', $p->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form method="POST" action="{{ route('career-paths.destroy', $p->id) }}"
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Xóa lộ trình này?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-3">Không có dữ liệu.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer text-right">
            {{ $paths->links('pagination::bootstrap-4') }}
        </div>
    </div>

</div>
@endsection
