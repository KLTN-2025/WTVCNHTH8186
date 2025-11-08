@extends('layouts.user')
@section('title', 'Tra cứu trường học')
@section('page_title', 'Trường học')
@section('heading', 'Tra cứu thông tin các trường đại học')

@section('content')
    <div class="max-w-6xl mx-auto">

        <!-- Thanh tìm kiếm và lọc -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <form method="GET" action="{{ route('user.universities') }}" class="flex-1 flex items-center gap-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Tìm tên trường, địa điểm..."
                    class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-primary/40 transition">
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>

            <form method="GET" action="{{ route('user.universities') }}" class="flex items-center gap-2">
                <select name="major_id"
                    class="px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-primary/40 transition">
                    <option value="">Tất cả ngành học</option>
                    @foreach($majors as $m)
                        <option value="{{ $m->id }}" {{ request('major_id') == $m->id ? 'selected' : '' }}>
                            {{ $m->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition">
                    <i class="fa-solid fa-filter"></i>
                </button>
            </form>
        </div>

        <!-- Danh sách trường -->
        @if($universities->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($universities as $u)
                    <div
                        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm hover:shadow-md transition p-5 flex flex-col">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-primary">{{ $u->name }}</h3>
                            <span class="text-xs text-gray-500 dark:text-gray-400">#{{ $u->ranking }}</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                            <i class="fa-solid fa-location-dot mr-1 text-primary"></i> {{ $u->location }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                            <i class="fa-solid fa-graduation-cap mr-1 text-primary"></i>
                            <strong>Ngành đào tạo:</strong>
                            @php
                                $linkedMajors = $u->majors->pluck('name')->take(3)->join(', ');
                                $hasMore = $u->majors->count() > 3;
                            @endphp
                            {{ $linkedMajors }}{{ $hasMore ? '...' : '' }}
                        </p>
                        <a href="{{ $u->website }}" target="_blank"
                            class="mt-auto inline-block text-sm text-blue-600 dark:text-blue-400 hover:underline">
                            <i class="fa-solid fa-globe mr-1"></i> Website trường
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Phân trang -->
            <div class="mt-6">
                {{ $universities->links('pagination::tailwind') }}
            </div>

        @else
            <div class="text-center py-10 text-gray-500 dark:text-gray-400">
                <i class="fa-solid fa-school-circle-xmark text-3xl mb-3"></i>
                <p>Không tìm thấy trường học nào phù hợp với tiêu chí của bạn.</p>
            </div>
        @endif

    </div>
@endsection