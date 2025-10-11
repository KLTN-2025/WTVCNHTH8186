<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Hệ thống tư vấn hướng nghiệp')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ asset('dist/img/AdminLTELogo.png') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home"></i> Trang chủ</a>
                </li> -->
            </ul>

            <!-- <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-right-from-bracket"></i> Đăng xuất
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                </li>
            </ul> -->
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('home') }}" class="brand-link text-center">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="Logo"
                    class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">HỆ THỐNG QUẢN LÝ</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                        {{-- Dành cho ADMIN --}}
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <li class="nav-header">QUẢN TRỊ HỆ THỐNG</li>
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}"
                                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chart-line"></i>
                                    <p>Trang Quản Trị</p>
                                </a>
                            </li>
                            
                            <li class="nav-header">QUẢN LÝ THÔNG TIN</li>

                            <li class="nav-item">
                                <a href="{{ route('majors.index') }}"
                                    class="nav-link {{ request()->routeIs('majors.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>Ngành Học</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('universities.index') }}"
                                    class="nav-link {{ request()->routeIs('universities.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-university"></i>
                                    <p>Trường Đại Học</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('users.index') }}"
                                    class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Người Dùng</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.logs') }}"
                                    class="nav-link {{ request()->routeIs('admin.logs') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-clipboard-list"></i>
                                    <p>Nhật Ký Hệ Thống</p>
                                </a>
                            </li>

                            <li class="nav-header">QUẢN LÝ ĐỊNH HƯỚNG</li>

                            <li class="nav-item">
                                <a href="{{ route('survey-questions.index') }}"
                                    class="nav-link {{ request()->routeIs('survey-questions.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-question-circle"></i>
                                    <p>Câu Hỏi Khảo Sát</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('survey-answers.index') }}"
                                    class="nav-link {{ request()->routeIs('survey-answers.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-list-ul"></i>
                                    <p>Câu Trả Lời Khảo Sát</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('major-university.index') }}"
                                    class="nav-link {{ request()->routeIs('major-university.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-link"></i>
                                    <p>Liên Kết Ngành – Trường</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('career-paths.index') }}"
                                    class="nav-link {{ request()->routeIs('career-paths.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-rocket"></i>
                                    <p>Lộ Trình Nghề Nghiệp</p>
                                </a>
                            </li>
                            
                        @endif

                        {{-- Dành cho USER --}}
                        @if(auth()->check() && auth()->user()->role === 'user')
                            <li class="nav-header">DÀNH CHO BẠN</li>

                            <li class="nav-item">
                                <a href="{{ route('survey.index') }}"
                                    class="nav-link {{ request()->routeIs('survey.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-clipboard-question"></i>
                                    <p>Khảo sát định hướng</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('chatbot.index') }}"
                                    class="nav-link {{ request()->routeIs('chatbot.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-robot"></i>
                                    <p>Trò chuyện cùng AI</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('user.majors.index') }}"
                                    class="nav-link {{ request()->routeIs('user.majors.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book-open"></i>
                                    <p>Danh sách ngành học</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('user.universities.index') }}"
                                    class="nav-link {{ request()->routeIs('user.universities.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-school"></i>
                                    <p>Danh sách trường</p>
                                </a>
                            </li>
                        @endif

                        {{-- Chung cho mọi người --}}
                        @if(auth()->check())
                            <li class="nav-header">QUẢN LÝ TÀI KHOẢN</li>
                            <li class="nav-item">
                                <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-circle"></i>
                                    <p>Cá Nhân</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>Đăng Xuất</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content -->
        <div class="content-wrapper p-3">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="main-footer text-left">
            <strong>&copy; 2025 - Hệ thống tư vấn hướng nghiệp AI.</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Phiên bản</b> 1.0.0
            </div>
        </footer>
    </div>

    <!-- JS -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {{-- Thông báo Toastr --}}
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>toastr.error('{{ $error }}', 'Lỗi');</script>
        @endforeach
    @endif

    @if (session('success'))
        <script>toastr.success('{{ session('success') }}', 'Thành công');</script>
    @endif

    @if (session('error'))
        <script>toastr.error('{{ session('error') }}', 'Thất bại');</script>
    @endif

    @yield('script')
</body>

</html>