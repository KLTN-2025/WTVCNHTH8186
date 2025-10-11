@extends('layouts.app')

@section('title', 'Quản lý người dùng')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4"><i class="fas fa-users"></i> Danh sách người dùng</h4>

    <form method="GET" action="{{ route('users.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-3 mb-2">
                <input type="text" name="keyword" class="form-control"
                    placeholder="Tìm theo tên hoặc email..." value="{{ $keyword ?? '' }}">
            </div>
            <div class="col-md-3 mb-2">
                <select name="status" class="form-control" onchange="this.form.submit()">
                    <option value="all" {{ $status == 'all' ? 'selected' : '' }}>-- Tất cả trạng thái --</option>
                    <option value="active" {{ $status == 'active' ? 'selected' : '' }}>Đang hoạt động</option>
                    <option value="blocked" {{ $status == 'blocked' ? 'selected' : '' }}>Đã bị chặn</option>
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <button class="btn btn-primary w-100"><i class="fas fa-search"></i> Tìm kiếm</button>
            </div>
            <div class="col-md-2 mb-2">
                <a href="{{ route('users.index') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-undo"></i> Làm mới
                </a>
            </div>
            <div class="col-md-2 mb-2">
                <a href="{{ route('users.create') }}" class="btn btn-primary w-100">
                    <i class="fas fa-plus"></i> Thêm mới
                </a>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Tên người dùng</th>
                        <th>Email</th>
                        <th width="15%" class="text-center">Trạng thái</th>
                        <th width="20%" class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">
                                @if($user->is_blocked)
                                    <span class="badge badge-danger">Đã chặn</span>
                                @else
                                    <span class="badge badge-success">Hoạt động</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa người dùng này?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <a href="{{ route('users.block', $user->id) }}" class="btn btn-sm btn-secondary">
                                    @if($user->is_blocked)
                                        <i class="fas fa-lock-open"></i>
                                    @else
                                        <i class="fas fa-user-lock"></i>
                                    @endif
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">Không có người dùng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer text-right">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
