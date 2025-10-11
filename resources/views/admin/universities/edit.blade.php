@extends('layouts.app')

@section('title', 'Chỉnh sửa thông tin trường đại học')

@section('content')
    <div class="container-fluid">

        <h4 class="mb-4"><i class="fas fa-edit"></i> Chỉnh sửa thông tin trường đại học</h4>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('universities.update', $university->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Tên trường --}}
                    <div class="form-group mb-3">
                        <label for="name">Tên trường đại học <span class="text-danger">*</span></label>
                        <select name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
                            <option value="">-- Chọn trường đại học --</option>

                            @php
                                $university_list = [
                                    'Đại học Bách Khoa Hà Nội',
                                    'Đại học Quốc gia Hà Nội',
                                    'Đại học Quốc gia TP. Hồ Chí Minh',
                                    'Đại học Kinh tế Quốc dân',
                                    'Đại học Ngoại thương',
                                    'Đại học Công nghệ Thông tin (UIT)',
                                    'Đại học FPT',
                                    'Đại học Bách Khoa TP. Hồ Chí Minh',
                                    'Đại học Khoa học Tự nhiên - ĐHQGHN',
                                    'Đại học Sư phạm Hà Nội',
                                    'Đại học Thương mại',
                                    'Đại học Tôn Đức Thắng',
                                    'Đại học Kinh tế TP. Hồ Chí Minh (UEH)',
                                    'Đại học Ngân hàng TP. Hồ Chí Minh',
                                    'Đại học Công nghiệp Hà Nội',
                                    'Đại học Công nghiệp TP. Hồ Chí Minh',
                                    'Đại học Giao thông Vận tải',
                                    'Đại học Mỏ - Địa chất',
                                    'Đại học Kiến trúc Hà Nội',
                                    'Đại học Kiến trúc TP. Hồ Chí Minh',
                                    'Đại học Nông Lâm TP. Hồ Chí Minh',
                                    'Đại học Nông nghiệp Hà Nội (Học viện Nông nghiệp)',
                                    'Đại học Y Hà Nội',
                                    'Đại học Y Dược TP. Hồ Chí Minh',
                                    'Đại học Dược Hà Nội',
                                    'Đại học Sư phạm Kỹ thuật TP. Hồ Chí Minh',
                                    'Đại học Văn Lang',
                                    'Đại học Hoa Sen',
                                    'Đại học Quốc tế Hồng Bàng',
                                    'Đại học Phenikaa',
                                    'Đại học Duy Tân',
                                    'Đại học Đà Nẵng',
                                    'Đại học Cần Thơ',
                                    'Đại học Tây Nguyên',
                                    'Đại học Hải Phòng',
                                    'Đại học Vinh',
                                    'Đại học Quy Nhơn',
                                    'Đại học Hạ Long',
                                    'Đại học Tài chính – Marketing',
                                    'Đại học Công nghệ Đông Á',
                                    'Đại học Khoa học Xã hội & Nhân văn',
                                    'Đại học Mở TP. Hồ Chí Minh',
                                    'Đại học Nguyễn Tất Thành',
                                    'Đại học HUTECH',
                                    'Đại học Văn Hiến',
                                    'Đại học Hồng Đức',
                                    'Đại học Lạc Hồng',
                                    'Đại học Hồng Bàng',
                                    'Đại học Quốc tế RMIT Việt Nam',
                                    'Học viện An ninh Nhân dân',
                                    'Học viện Cảnh sát Nhân dân',
                                    'Học viện Báo chí và Tuyên truyền',
                                    'Học viện Ngoại giao',
                                    'Học viện Ngân hàng',
                                    'Học viện Tài chính'
                                ];
                            @endphp

                            @foreach ($university_list as $uni)
                                <option value="{{ $uni }}" {{ old('name', $university->name) == $uni ? 'selected' : '' }}>
                                    {{ $uni }}
                                </option>
                            @endforeach
                        </select>

                        @error('name')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Địa điểm --}}
                    <div class="form-group mb-3">
                        <label for="location">Địa điểm</label>
                        <input type="text" name="location" id="location"
                               value="{{ old('location', $university->location) }}"
                               class="form-control @error('location') is-invalid @enderror"
                               placeholder="Ví dụ: Hà Nội, TP. Hồ Chí Minh, Đà Nẵng...">
                        @error('location')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Website --}}
                    <div class="form-group mb-3">
                        <label for="website">Website</label>
                        <input type="url" name="website" id="website"
                               value="{{ old('website', $university->website) }}"
                               class="form-control @error('website') is-invalid @enderror"
                               placeholder="https://www.ten-truong.edu.vn">
                        @error('website')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Xếp hạng --}}
                    <div class="form-group mb-3">
                        <label for="ranking">Xếp hạng (nếu có)</label>
                        <input type="number" name="ranking" id="ranking"
                               value="{{ old('ranking', $university->ranking) }}"
                               class="form-control @error('ranking') is-invalid @enderror"
                               placeholder="Ví dụ: 1, 2, 3...">
                        @error('ranking')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Nút hành động --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('universities.index') }}" class="btn btn-secondary">
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
