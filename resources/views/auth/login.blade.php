<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Nhập | Hệ Thống Tư Vấn Hướng Nghiệp</title>

    <link rel="icon" type="image/png" href="{{ asset('dist/img/AdminLTELogo.png') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;600&display=swap" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        body {
            font-family: 'Be Vietnam Pro', sans-serif;
            background: linear-gradient(120deg, #007bff, #6610f2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            width: 400px;
        }

        .login-logo a {
            color: #343a40;
            font-weight: 700;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: #007bff;
            border: none;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: #0069d9;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <div class="login-logo mb-3">
                    <a href="#"><b>ĐĂNG NHẬP</b></a>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Nhập email"
                            value="{{ old('email') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-7">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Ghi nhớ đăng nhập</label>
                            </div>
                        </div>
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary btn-block">Đăng Nhập</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @if (session('success'))
        <script>
            $(document).ready(function () {
                toastr.success('{{ session('success') }}', 'Thành công', { timeOut: 3000, progressBar: true });
            });
        </script>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                $(document).ready(function () {
                    toastr.error('{{ $error }}', 'Lỗi đăng nhập', {
                        closeButton: true,
                        progressBar: true,
                        positionClass: 'toast-top-right',
                        timeOut: 5000
                    });
                });
            </script>
        @endforeach
    @endif
</body>

</html>