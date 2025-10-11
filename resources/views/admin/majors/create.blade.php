@extends('layouts.app')

@section('title', 'Thêm ngành học mới')

@section('content')
    <div class="container-fluid">

        <h4 class="mb-4"><i class="fas fa-plus-circle"></i> Thêm ngành học mới</h4>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('majors.store') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name">Tên ngành học <span class="text-danger">*</span></label>
                        <select name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
                            <option value="">-- Chọn ngành học --</option>

                            @php
                                $majors_list = [
                                    'Công nghệ thông tin',
                                    'Khoa học máy tính',
                                    'Kỹ thuật phần mềm',
                                    'Hệ thống thông tin',
                                    'An toàn thông tin',
                                    'Trí tuệ nhân tạo',
                                    'Điện - Điện tử',
                                    'Cơ điện tử',
                                    'Cơ khí chế tạo máy',
                                    'Tự động hóa',
                                    'Kỹ thuật ô tô',
                                    'Xây dựng dân dụng & công nghiệp',
                                    'Kiến trúc',
                                    'Thiết kế nội thất',
                                    'Thiết kế đồ họa',
                                    'Thiết kế thời trang',
                                    'Kinh tế',
                                    'Quản trị kinh doanh',
                                    'Tài chính - Ngân hàng',
                                    'Kế toán',
                                    'Marketing',
                                    'Thương mại điện tử',
                                    'Quản trị du lịch & lữ hành',
                                    'Nhà hàng - Khách sạn',
                                    'Luật',
                                    'Luật kinh tế',
                                    'Ngôn ngữ Anh',
                                    'Ngôn ngữ Trung Quốc',
                                    'Ngôn ngữ Nhật',
                                    'Ngôn ngữ Hàn',
                                    'Sư phạm Toán học',
                                    'Sư phạm Ngữ văn',
                                    'Sư phạm Tiếng Anh',
                                    'Sư phạm Tin học',
                                    'Khoa học môi trường',
                                    'Sinh học',
                                    'Hóa học',
                                    'Vật lý học',
                                    'Công nghệ thực phẩm',
                                    'Công nghệ sinh học',
                                    'Y học',
                                    'Điều dưỡng',
                                    'Dược học',
                                    'Răng - Hàm - Mặt',
                                    'Kỹ thuật xét nghiệm y học',
                                    'Kỹ thuật hình ảnh y học',
                                    'Tâm lý học',
                                    'Công tác xã hội',
                                    'Truyền thông đa phương tiện',
                                    'Báo chí',
                                    'Quan hệ công chúng',
                                    'Quan hệ quốc tế',
                                    'Chính trị học',
                                    'Khoa học dữ liệu',
                                    'Toán ứng dụng',
                                    'Thống kê',
                                    'Kỹ thuật hạt nhân',
                                    'Vũ trụ & Hàng không',
                                    'Quản lý đất đai',
                                    'Lâm nghiệp',
                                    'Nông học',
                                    'Thú y',
                                    'Công nghệ chế biến nông sản',
                                    'Kỹ thuật nhiệt',
                                    'Logistics & Quản lý chuỗi cung ứng',
                                    'Kinh tế quốc tế',
                                    'Quản lý công nghiệp',
                                    'Khoa học vật liệu',
                                    'Khoa học máy tính ứng dụng'
                                ];
                            @endphp

                            @foreach ($majors_list as $major_name)
                                <option value="{{ $major_name }}" {{ old('name', $major->name ?? '') == $major_name ? 'selected' : '' }}>
                                    {{ $major_name }}
                                </option>
                            @endforeach
                        </select>

                        @error('name')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group mb-3">
                        <label for="description">Mô tả ngành học</label>
                        <textarea name="description" id="description" rows="3"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Giới thiệu khái quát về ngành">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="requirements">Yêu cầu đầu vào</label>
                        <textarea name="requirements" id="requirements" rows="3"
                            class="form-control @error('requirements') is-invalid @enderror"
                            placeholder="Ví dụ: Học tốt Toán, Lý, Tin học...">{{ old('requirements') }}</textarea>
                        @error('requirements')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="career_opportunities">Cơ hội nghề nghiệp</label>
                        <textarea name="career_opportunities" id="career_opportunities" rows="3"
                            class="form-control @error('career_opportunities') is-invalid @enderror"
                            placeholder="Ví dụ: Lập trình viên, Kỹ sư phần mềm, Quản trị hệ thống...">{{ old('career_opportunities') }}</textarea>
                        @error('career_opportunities')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('majors.index') }}" class="btn btn-secondary">
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