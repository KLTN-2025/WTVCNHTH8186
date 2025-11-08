@extends('layouts.user')
@section('title', 'Tài liệu hướng dẫn')
@section('page_title', 'Hướng dẫn')
@section('heading', 'Tài liệu hướng dẫn sử dụng hệ thống')

@section('content')
    <div class="mx-auto">

        <!-- Giới thiệu -->
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-semibold text-primary mb-2">Tài liệu hướng dẫn CareerGuide</h2>
            <p class="text-gray-600 dark:text-gray-400 text-sm">
                Trang này giúp bạn hiểu rõ cách sử dụng các chức năng chính trong hệ thống định hướng ngành học.
            </p>
        </div>

        <!-- Mục lục -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-6 mb-8">
            <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-3"><i
                    class="fa-solid fa-list mr-2 text-primary"></i>Mục lục</h3>
            <ul class="list-disc list-inside text-sm text-gray-700 dark:text-gray-300 space-y-1">
                <li><a href="#dang-nhap" class="hover:text-primary">Đăng nhập & Đăng ký</a></li>
                <li><a href="#khao-sat" class="hover:text-primary">Làm khảo sát định hướng</a></li>
                <li><a href="#chat-ai" class="hover:text-primary">Chat với AI tư vấn</a></li>
                <li><a href="#truong-hoc" class="hover:text-primary">Tra cứu trường học</a></li>
                <li><a href="#ket-qua" class="hover:text-primary">Xem kết quả gợi ý</a></li>
            </ul>
        </div>

        <!-- Nội dung hướng dẫn -->
        <div class="space-y-8 text-sm leading-relaxed text-gray-700 dark:text-gray-300">

            <section id="dang-nhap">
                <h3 class="text-lg font-semibold text-primary mb-2"><i class="fa-solid fa-user-lock mr-1"></i> Đăng nhập &
                    Đăng ký</h3>
                <p>Người dùng cần có tài khoản để truy cập hệ thống. Chọn <strong>Đăng ký</strong> nếu bạn chưa có tài
                    khoản, sau đó sử dụng email và mật khẩu để đăng nhập.</p>
            </section>

            <section id="khao-sat">
                <h3 class="text-lg font-semibold text-primary mb-2"><i class="fa-solid fa-list-check mr-1"></i> Làm khảo sát
                    định hướng</h3>
                <p>Chọn mục <strong>"Làm khảo sát"</strong> trong menu. Trả lời lần lượt các câu hỏi để hệ thống phân tích
                    điểm mạnh, sở thích và đưa ra gợi ý ngành học phù hợp.</p>
                <ul class="list-disc list-inside mt-2">
                    <li>Mỗi câu hỏi có thể là trắc nghiệm đơn hoặc nhiều lựa chọn.</li>
                    <li>Hoàn thành tất cả câu hỏi để xem kết quả gợi ý.</li>
                </ul>
            </section>

            <section id="chat-ai">
                <h3 class="text-lg font-semibold text-primary mb-2"><i class="fa-solid fa-comments mr-1"></i> Chat với AI tư
                    vấn</h3>
                <p>AI sẽ giúp bạn giải đáp câu hỏi như: <em>“Em học giỏi Toán và thích máy tính thì nên chọn ngành
                        nào?”</em>.
                    Trò chuyện tự nhiên như với một chuyên gia tư vấn thực thụ.</p>
            </section>

            <section id="truong-hoc">
                <h3 class="text-lg font-semibold text-primary mb-2"><i class="fa-solid fa-building-columns mr-1"></i> Tra
                    cứu trường học</h3>
                <p>Truy cập mục <strong>Trường học</strong> để xem danh sách các trường đại học, vị trí, ngành đào tạo, thứ
                    hạng và website chính thức.</p>
                <p>Có thể lọc theo ngành học hoặc tìm theo tên trường, địa điểm.</p>
            </section>

            <section id="ket-qua">
                <h3 class="text-lg font-semibold text-primary mb-2"><i class="fa-solid fa-chart-line mr-1"></i> Xem kết quả
                    gợi ý</h3>
                <p>Sau khi hoàn thành khảo sát, bạn sẽ thấy ngành học phù hợp nhất cùng mô tả, yêu cầu và cơ hội nghề
                    nghiệp.</p>
                <p>Từ kết quả này, bạn có thể tra cứu trường đào tạo tương ứng để đăng ký học phù hợp với năng lực của mình.
                </p>
            </section>
        </div>
    </div>
@endsection