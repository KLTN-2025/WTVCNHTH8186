@extends('layouts.user')

@section('title', 'Kết quả khảo sát')
@section('page_title', 'Kết quả')
@section('heading', 'Kết quả khảo sát định hướng')

@section('content')

    <div class="mx-auto space-y-10">

        {{-- HEADER --}}
        <div class="text-center">
            <h2 class="text-3xl font-bold text-primary mb-2">Kết quả khảo sát</h2>
            <p class="text-gray-600 dark:text-gray-400">Dưới đây là phân tích dựa trên câu trả lời của bạn.</p>
        </div>

        {{-- NGÀNH ĐƯỢC GỢI Ý --}}
        <div
            class="relative overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-lg p-8">

            <div
                class="absolute top-0 right-0 w-40 h-40 bg-primary opacity-10 rounded-full -translate-y-1/2 translate-x-1/3">
            </div>

            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                Ngành phù hợp: <span class="text-primary">{{ $major->name }}</span>
            </h3>

            <p class="text-gray-700 dark:text-gray-300 mb-6">
                <span class="font-semibold">Điểm đánh giá:</span>
                <span class="text-primary font-bold">{{ $result->score }}/100</span>
            </p>

            <div class="space-y-6">

                @if($major->description)
                    <div>
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">Mô tả ngành</h4>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                            {{ $major->description }}
                        </p>
                    </div>
                @endif

                @if($major->requirements)
                    <div>
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">Yêu cầu</h4>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                            {{ $major->requirements }}
                        </p>
                    </div>
                @endif

                @if($major->career_opportunities)
                    <div>
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">Cơ hội nghề nghiệp</h4>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                            {{ $major->career_opportunities }}
                        </p>
                    </div>
                @endif

            </div>
        </div>

        @if($major->universities->count())
    <section class="mt-10">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
            Các trường đại học phù hợp
        </h2>

        <div class="grid md:grid-cols-2 gap-6">

            @foreach($major->universities as $u)
                <div
                    class="group p-6 rounded-2xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 shadow-sm hover:shadow-lg hover:border-primary transition-all duration-200">

                    <div class="flex items-start justify-between">
                        <h3 class="text-xl font-semibold text-primary group-hover:text-primary/90 transition">
                            {{ $u->name }}
                        </h3>

                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                            <i class="fa-solid fa-graduation-cap text-primary"></i>
                        </div>
                    </div>

                    <div class="mt-3 space-y-2 text-gray-700 dark:text-gray-300">

                        @if($u->location)
                            <p class="text-sm flex items-center gap-2">
                                <i class="fa-solid fa-location-dot text-primary"></i>
                                {{ $u->location }}
                            </p>
                        @endif

                        @if($u->ranking)
                            <p class="text-sm flex items-center gap-2">
                                <i class="fa-solid fa-ranking-star text-yellow-500"></i>
                                Xếp hạng: {{ $u->ranking }}
                            </p>
                        @endif

                        @if($u->website)
                            <a href="{{ $u->website }}" target="_blank"
                               class="text-sm text-blue-600 dark:text-blue-400 underline hover:text-blue-700 transition flex items-center gap-1">
                                <i class="fa-solid fa-globe"></i>
                                Website
                            </a>
                        @endif

                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endif
        {{-- CÂU TRẢ LỜI --}}
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-lg p-8">

            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                Chi tiết câu trả lời
            </h3>

            <div class="space-y-6">

                @foreach($answers as $index => $a)
                    <div class="flex gap-4">

                        {{-- Timeline icon --}}
                        <div class="flex flex-col items-center">
                            <div class="h-5 w-5 rounded-full bg-primary"></div>
                            @if(!$loop->last)
                                <div class="flex-1 w-1 bg-primary opacity-40"></div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div
                            class="flex-1 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-5">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                {{ $index + 1 }}. {{ $a->question->question_text }}
                            </h4>

                            <p class="text-primary font-semibold text-lg">
                                {{ $a->answer }}
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>

@endsection