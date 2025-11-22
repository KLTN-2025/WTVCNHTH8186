@extends('layouts.user')
@section('title', 'Trang chủ')

@section('content')

<div class="relative overflow-hidden">

    {{-- Background gradient --}}
    <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-blue-100/20 to-purple-200/20 dark:from-primary/20 dark:via-gray-900 dark:to-gray-800 pointer-events-none"></div>

    <div class="relative max-w-6xl mx-auto py-20 px-6">

        {{-- HERO --}}
        <div class="text-center space-y-6">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white">
                Chào mừng bạn đến với hệ thống
                <span class="text-primary">Định Hướng Ngành Học</span>
            </h1>

            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Khám phá ngành nghề phù hợp với tính cách, sở thích và năng lực của bạn.
                Bắt đầu hành trình tương lai một cách rõ ràng và tự tin hơn.
            </p>

            <div class="mt-8 flex justify-center gap-4">
                <a href="{{ route('survey.index') }}"
                   class="px-8 py-3 bg-primary hover:bg-primary/90 text-white font-semibold rounded-xl shadow-lg transition">
                    Bắt đầu khảo sát
                </a>

                <a href="{{ route('survey.result') }}"
                   class="px-8 py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-200 rounded-xl shadow hover:shadow-md transition">
                    Xem kết quả của tôi
                </a>
            </div>
        </div>

        {{-- FEATURES --}}
        <div class="mt-20 grid md:grid-cols-3 gap-8">

            <div class="p-6 rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow hover:shadow-lg transition">
                <div class="w-12 h-12 flex items-center justify-center bg-primary/10 rounded-xl mb-4">
                    <i class="fa-solid fa-brain text-primary text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                    Phân tích tính cách
                </h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                    Hệ thống đánh giá dựa trên sở thích và xu hướng cá nhân để tìm ngành phù hợp nhất.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow hover:shadow-lg transition">
                <div class="w-12 h-12 flex items-center justify-center bg-primary/10 rounded-xl mb-4">
                    <i class="fa-solid fa-graduation-cap text-primary text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                    Gợi ý ngành học chính xác
                </h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                    Thuật toán đề xuất ngành nghề dựa trên tập dữ liệu đầy đủ và có trọng số.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow hover:shadow-lg transition">
                <div class="w-12 h-12 flex items-center justify-center bg-primary/10 rounded-xl mb-4">
                    <i class="fa-solid fa-school text-primary text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                    Gợi ý trường đại học
                </h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                    Danh sách trường phù hợp theo từng ngành để bạn lựa chọn nơi theo học tốt nhất.
                </p>
            </div>

        </div>

    </div>

</div>

@endsection
