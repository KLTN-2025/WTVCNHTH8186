<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Hệ thống Định hướng Ngành học')</title>

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
                        <a href="#" class="flex items-center gap-2">
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

                        <a href="#"
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

        <!-- SIDEBAR -->
        <aside id="sidebar"
            class="fixed md:static top-[72px] left-0 w-72 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 flex flex-col transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-30">

            <div class="px-4 py-3">
                <a href="#"
                    class="block w-full rounded-xl bg-gradient-to-br from-primary/10 to-blue-200/30 dark:from-blue-500/10 dark:to-blue-400/10 p-4">
                    <div class="text-sm text-gray-600 dark:text-gray-300">Tiến trình</div>
                    <div class="mt-2 h-2 w-full rounded-full bg-gray-200 dark:bg-gray-800 overflow-hidden">
                        <div class="h-2 bg-primary rounded-full" style="width: 42%;"></div>
                    </div>
                    <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">Khảo sát: 6/14 câu</div>
                </a>
            </div>

            <nav class="flex-1 overflow-y-auto px-3 pb-3 space-y-1">
                <a href="{{ route('home') }}" data-path="/"
                    class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <i class="fa-solid fa-house"></i><span>Trang chủ</span>
                </a>
                <a href="{{ route('survey.index') }}" data-path="/survey"
                    class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <i class="fa-solid fa-list-check"></i><span>Làm khảo sát</span>
                    <span class="ml-auto text-[10px] px-2 py-0.5 rounded bg-primary/10 text-primary">Mới</span>
                </a>
                <a href="#" data-path="/chat"
                    class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <i class="fa-solid fa-comments"></i><span>Chat với AI</span>
                </a>
                <a href="#" data-path="/universities"
                    class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <i class="fa-solid fa-building-columns"></i><span>Trường học</span>
                </a>
                <a href="#" data-path="/results"
                    class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <i class="fa-solid fa-chart-line"></i><span>Kết quả</span>
                </a>

                <div class="pt-3 mt-3 border-t border-gray-200 dark:border-gray-800">
                    <div class="px-3 pb-1 text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Hỗ trợ</div>
                    <a href="#"
                        class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                        <i class="fa-solid fa-book-open-reader"></i><span>Tài liệu hướng dẫn</span>
                    </a>
                    <a href="#"
                        class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                        <i class="fa-solid fa-headset"></i><span>Liên hệ hỗ trợ</span>
                    </a>
                </div>
            </nav>

            <!-- <div class="border-t border-gray-200 dark:border-gray-800 p-4">
                <form method="POST" action="#">
                    @csrf
                    <button
                        class="w-full py-2 rounded-lg bg-primary text-white hover:bg-blue-700 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                    </button>
                </form>
            </div> -->
        </aside>

        <!-- MAIN -->
        <main class="flex-1 p-10">
            @yield('content')
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