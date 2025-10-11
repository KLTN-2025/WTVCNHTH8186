@extends('layouts.app')

@section('title', 'Nhật ký hệ thống')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4"><i class="fas fa-clipboard-list"></i> Nhật ký hoạt động hệ thống</h4>

    {{-- Form tìm kiếm --}}
    <form method="GET" action="{{ route('admin.logs') }}" class="mb-3">
        <div class="row">
            <div class="col-md-3 mb-2">
                <input type="text" name="keyword" value="{{ $keyword ?? '' }}" class="form-control"
                       placeholder="Tìm theo hành động, người dùng, IP hoặc mô tả...">
            </div>

            <div class="col-md-2 mb-2">
                <input type="date" name="from_date" value="{{ $fromDate ?? '' }}" class="form-control"
                       placeholder="Từ ngày">
            </div>

            <div class="col-md-2 mb-2">
                <input type="date" name="to_date" value="{{ $toDate ?? '' }}" class="form-control"
                       placeholder="Đến ngày">
            </div>

            <div class="col-md-2 mb-2">
                <button class="btn btn-primary w-100"><i class="fas fa-search"></i> Lọc</button>
            </div>

            <div class="col-md-2 mb-2">
                <a href="{{ route('admin.logs') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-undo"></i> Làm mới
                </a>
            </div>
        </div>
    </form>

    {{-- Bảng logs --}}
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Người dùng</th>
                        <th>Hành động</th>
                        <th>Mô tả chi tiết</th>
                        <th>Địa chỉ IP</th>
                        <th>Thời gian</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $logs->firstItem() + $loop->index }}</td>
                            <td>{{ $log->user_name ?? 'Không xác định' }}</td>
                            <td>{{ $log->action ?? '---' }}</td>
                            <td>{{ $log->description ?? '---' }}</td>
                            <td>{{ $log->ip_address ?? '---' }}</td>
                            <td>{{ $log->created_at ? $log->created_at->format('d/m/Y H:i') : '---' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">
                                Không có bản ghi nào phù hợp.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer text-right">
            {{ $logs->links('pagination::bootstrap-4') }}
        </div>
    </div>

</div>
@endsection
