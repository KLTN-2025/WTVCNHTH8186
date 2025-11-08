@extends('layouts.user')
@section('title', 'Liên hệ hỗ trợ')
@section('page_title', 'Hỗ trợ')
@section('heading', 'Liên hệ hỗ trợ kỹ thuật & tư vấn')

@section('content')
    <div class="mx-auto">

        <!-- Tiêu đề -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-semibold text-primary mb-2">Trung tâm hỗ trợ CareerGuide</h2>
            <p class="text-gray-600 dark:text-gray-400 text-sm">
                Nếu bạn gặp sự cố hoặc có góp ý, vui lòng gửi thông tin cho chúng tôi.
                Đội ngũ hỗ trợ sẽ phản hồi sớm nhất có thể.
            </p>
        </div>

        <!-- Thông tin liên hệ -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5 text-center">
                <div class="text-primary text-2xl mb-2"><i class="fa-solid fa-envelope"></i></div>
                <h4 class="font-semibold text-gray-800 dark:text-gray-100 mb-1">Email hỗ trợ</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">support@careerguide.vn</p>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5 text-center">
                <div class="text-primary text-2xl mb-2"><i class="fa-solid fa-phone"></i></div>
                <h4 class="font-semibold text-gray-800 dark:text-gray-100 mb-1">Hotline</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">0888 456 789</p>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5 text-center">
                <div class="text-primary text-2xl mb-2"><i class="fa-solid fa-location-dot"></i></div>
                <h4 class="font-semibold text-gray-800 dark:text-gray-100 mb-1">Văn phòng</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">Số 01 Nguyễn Huệ, Phường Hải Châu, Đà Nẵng</p>
            </div>
        </div>

        <!-- Form liên hệ -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-100 mb-4">
                <i class="fa-solid fa-paper-plane text-primary mr-1"></i> Gửi phản hồi hoặc yêu cầu hỗ trợ
            </h3>

            <form method="POST" action="#" class="space-y-4">
                @csrf
                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 block">Tên của bạn</label>
                    <input type="text" name="name" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-primary/40 text-sm">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 block">Email liên hệ</label>
                    <input type="email" name="email" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-primary/40 text-sm">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 block">Nội dung cần hỗ
                        trợ</label>
                    <textarea name="message" rows="5" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-primary/40 text-sm"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fa-solid fa-paper-plane mr-1"></i> Gửi yêu cầu
                    </button>
                </div>
            </form>
        </div>

        <!-- Ghi chú -->
        <div class="mt-8 text-center text-xs text-gray-500 dark:text-gray-400">
            <p><i class="fa-solid fa-circle-info mr-1 text-primary"></i>
                Thời gian phản hồi trung bình: <strong>trong vòng 24 giờ làm việc</strong>.
            </p>
        </div>
    </div>
@endsection