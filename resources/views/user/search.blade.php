@extends('layouts.user')

@section('title', 'Kết quả tìm kiếm')
@section('page_title', 'Tìm kiếm')
@section('heading', 'Kết quả tìm kiếm')

@section('content')

<div class="mx-auto space-y-10">

    {{-- HEADER --}}
    <div class="text-center">
        <h2 class="text-3xl font-bold text-primary mb-2">Kết quả tìm kiếm</h2>
        <p class="text-gray-600 dark:text-gray-400">
            Từ khóa: <span class="font-semibold text-primary">{{ $q }}</span>
        </p>
    </div>

    {{-- KẾT QUẢ NGÀNH HỌC --}}
    <div class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-lg p-8">

        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
            Ngành học phù hợp
        </h3>

        @if($majors->count())
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($majors as $m)
                    <div class="p-6 rounded-2xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-lg transition">

                        <h4 class="text-xl font-semibold text-primary mb-2">{{ $m->name }}</h4>

                        @if($m->description)
                            <p class="text-gray-700 dark:text-gray-300 text-sm line-clamp-3">
                                {{ $m->description }}
                            </p>
                        @endif

                        <a href="{{ route('major.show', $m->id) }}"
                           class="text-blue-600 dark:text-blue-400 underline text-sm mt-3 inline-block">
                            Xem chi tiết
                        </a>

                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400">Không tìm thấy ngành nào.</p>
        @endif

    </div>


    {{-- KẾT QUẢ TRƯỜNG HỌC --}}
    <div class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-lg p-8">

        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
            Trường đại học liên quan
        </h3>

        @if($universities->count())
            <div class="grid md:grid-cols-2 gap-6">

                @foreach($universities as $u)
                    <div class="p-6 rounded-2xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-lg transition">

                        <h4 class="text-xl font-semibold text-primary">{{ $u->name }}</h4>

                        <div class="mt-3 text-gray-700 dark:text-gray-300 text-sm space-y-1">

                            @if($u->location)
                                <p class="flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot text-primary"></i>
                                    {{ $u->location }}
                                </p>
                            @endif

                            @if($u->ranking)
                                <p class="flex items-center gap-2">
                                    <i class="fa-solid fa-ranking-star text-yellow-500"></i>
                                    Xếp hạng: {{ $u->ranking }}
                                </p>
                            @endif

                            @if($u->website)
                                <a href="{{ $u->website }}" target="_blank"
                                   class="text-blue-600 dark:text-blue-400 underline">
                                    Website
                                </a>
                            @endif

                        </div>

                    </div>
                @endforeach

            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400">Không tìm thấy trường nào.</p>
        @endif
    </div>


    {{-- KẾT QUẢ CÂU HỎI KHẢO SÁT --}}
    <div class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-lg p-8">

        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
            Câu hỏi khảo sát liên quan
        </h3>

        @if($questions->count())
            <div class="space-y-6">
                @foreach($questions as $qItem)
                    <div class="p-5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700">
                        <p class="text-gray-800 dark:text-gray-200 font-semibold">
                            {{ $qItem->question_text }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400">Không tìm thấy câu hỏi khảo sát nào.</p>
        @endif

    </div>

</div>

@endsection
