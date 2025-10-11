@extends('layouts.app')

@section('title', 'Bảng điều khiển - Quản trị hệ thống')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4"><i class="fas fa-tachometer-alt"></i> Bảng điều khiển</h4>

    {{-- Thống kê nhanh --}}
    <div class="row">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="info-box bg-primary">
                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Người dùng</span>
                    <span class="info-box-number">{{ number_format($stats['total_users']) }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fas fa-user-shield"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Quản trị viên</span>
                    <span class="info-box-number">{{ number_format($stats['total_admins']) }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="info-box bg-warning">
                <span class="info-box-icon"><i class="fas fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Ngành học</span>
                    <span class="info-box-number">{{ number_format($stats['total_majors']) }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="info-box bg-danger">
                <span class="info-box-icon"><i class="fas fa-university"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Trường đại học</span>
                    <span class="info-box-number">{{ number_format($stats['total_universities']) }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="info-box bg-info">
                <span class="info-box-icon"><i class="fas fa-clipboard-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Khảo sát đã thực hiện</span>
                    <span class="info-box-number">{{ number_format($stats['total_surveys']) }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Nhật ký hệ thống --}}
    <div class="card mt-4">
        <div class="card-header bg-dark text-white">
            <h5 class="card-title mb-0"><i class="fas fa-clipboard-list"></i> Nhật ký hoạt động gần đây</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th width="20%">Hành động</th>
                        <th>Nội dung chi tiết</th>
                        <th width="25%">Thời gian</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latest_logs as $index => $log)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="badge bg-primary">{{ $log->action }}</span></td>
                            <td>{{ $log->details }}</td>
                            <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">Chưa có hoạt động nào gần đây.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
