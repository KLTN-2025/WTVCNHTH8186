<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Hệ thống Định hướng Ngành học')</title>
    <meta name="description" content="Hệ thống định hướng ngành học và tư vấn nghề nghiệp cho học sinh sinh viên." />
    <meta name="author" content="CareerGuide Team" />
    <meta name="keywords"
        content="định hướng ngành học, tư vấn nghề nghiệp, khảo sát ngành học, chat AI, tra cứu trường học" />
    <link rel="icon" type="image/x-icon"
        href="https://assets-global.website-files.com/5d48b7ac15f2c10c0ffae816/5d64ea576ed3ee71a1a0cd71_cropped-Site-Favicon-256.png" />
    <!-- Tailwind + Flowbite + FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        'primary-50': '#eff6ff',
                        'primary-600': '#2563eb',
                        'ink': '#0f172a'
                    },
                    boxShadow: {
                        soft: '0 8px 24px rgba(15, 23, 42, .06)',
                    }
                },
            },
        };
    </script>

    <style>
        /* Scrollbar tinh gọn */
        * {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        *::-webkit-scrollbar {
            height: 8px;
            width: 8px;
        }

        *::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 8px;
        }

        .glass {
            background: rgba(255, 255, 255, .8);
            backdrop-filter: saturate(140%) blur(8px);
        }

        .dark .glass {
            background: rgba(2, 6, 23, .7);
        }

        /* Nav active by JS: .active */
        .nav-link.active {
            background: rgba(37, 99, 235, .12);
            color: #1d4ed8;
        }

        .dark .nav-link.active {
            background: rgba(59, 130, 246, .18);
            color: #93c5fd;
        }
    </style>
</head>

<body
    class="bg-gray-50 dark:bg-gray-900 text-ink/90 dark:text-gray-200 flex flex-col min-h-screen transition-all duration-300 ease-in-out">

    <!-- HEADER -->
    <header class="fixed top-0 left-0 right-0 z-40 border-b border-gray-200 dark:border-gray-700">
        <div class="glass shadow-soft">
            <div class="mx-auto max-w-7xl px-4 sm:px-6">
                <div class="flex items-center justify-between py-3">
                    <div class="flex items-center gap-3">
                        <button id="menuBtn" class="md:hidden text-2xl text-gray-700 dark:text-gray-200">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                        <a href="{{ route('home') }}" class="flex items-center gap-2">
                            <span
                                class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-primary text-white">
                                <i class="fa-solid fa-compass"></i>
                            </span>
                            <span class="text-xl font-semibold text-primary">CareerGuide</span>
                        </a>
                    </div>

                    <div class="hidden md:flex items-center gap-3 flex-1 max-w-xl mx-6">
                        <div class="relative flex-1">
                            <i
                                class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="search" placeholder="Tìm ngành, trường, câu hỏi…"
                                class="w-full rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 pl-10 pr-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/40">
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button id="toggleTheme"
                            class="h-10 w-10 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-primary-50 dark:hover:bg-gray-800 flex items-center justify-center transition">
                            <i class="fa-solid fa-moon"></i>
                        </button>

                        <a href="{{ route('user.login') }}"
                            class="hidden sm:flex items-center gap-3 px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-primary/60 transition">
                            <span
                                class="relative inline-flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-primary to-blue-400 text-white">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <div class="text-left leading-tight">
                                <div class="text-sm font-medium">Tài khoản</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Cài đặt & hồ sơ</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- WRAPPER -->
    <div class="flex flex-1 pt-[72px]">

        <!-- MAIN -->
        <main class="flex-1">
            <div class="relative overflow-hidden">

                {{-- Background gradient --}}
                <div
                    class="absolute inset-0 bg-gradient-to-br from-primary/10 via-blue-100/20 to-purple-200/20 dark:from-primary/20 dark:via-gray-900 dark:to-gray-800 pointer-events-none">
                </div>

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
                                Bắt đầu
                            </a>

                            <a href="{{ route('user.register') }}"
                                class="px-8 py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-200 rounded-xl shadow hover:shadow-md transition">
                                Đăng ký
                            </a>
                        </div>
                    </div>

                    {{-- FEATURES --}}
                    <div class="mt-20 grid md:grid-cols-3 gap-8">

                        <div
                            class="p-6 rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow hover:shadow-lg transition">
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

                        <div
                            class="p-6 rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow hover:shadow-lg transition">
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

                        <div
                            class="p-6 rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow hover:shadow-lg transition">
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
        </main>

    </div>
    <!-- FOOTER -->
    <footer class="border-t border-gray-200 dark:border-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
            © 2025 CareerGuide — All rights reserved.
        </div>
    </footer>
    <!-- SCRIPT -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const menuBtn = document.getElementById('menuBtn');
        const themeBtn = document.getElementById('toggleTheme');
        const themeIcon = themeBtn.querySelector('i');

        // Toggle sidebar mobile
        menuBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Persist theme
        const saved = localStorage.getItem('theme');
        if (saved === 'dark') {
            document.documentElement.classList.add('dark');
            themeIcon.className = 'fa-solid fa-sun text-yellow-400';
        }

        themeBtn?.addEventListener('click', () => {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            themeIcon.className = isDark ? 'fa-solid fa-sun text-yellow-400' : 'fa-solid fa-moon';
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });

        // Đánh dấu menu active theo path (thay data-path đúng route của bạn)
        const links = document.querySelectorAll('.nav-link[data-path]');
        const path = location.pathname.replace(/\/+$/, '') || '/';
        links.forEach(a => {
            const p = a.getAttribute('data-path');
            if (p === path || (p !== '/' && path.startsWith(p))) a.classList.add('active');
        });
    </script>
</body>

</html>