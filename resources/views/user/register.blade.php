<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - CareerGuide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="https://assets-global.website-files.com/5d48b7ac15f2c10c0ffae816/5d64ea576ed3ee71a1a0cd71_cropped-Site-Favicon-256.png" />
    <!-- Tailwind + Flowbite + FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 transition-colors">
    <div
        class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 border border-gray-200 dark:border-gray-700">
        <div class="text-center mb-6">
            <div class="inline-flex h-12 w-12 items-center justify-center rounded-lg bg-primary text-white">
                <i class="fa-solid fa-compass" style="color: rgb(29 78 216 / var(--tw-bg-opacity, 1)); font-size: 45px;"></i>
            </div>
            <h2 class="text-2xl font-bold text-primary mt-3">Đăng ký tài khoản</h2>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Tạo tài khoản để bắt đầu định hướng ngành học</p>
        </div>

        <form method="POST" action="{{ route('user.register') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Họ và tên</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-primary/40 text-sm">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-primary/40 text-sm">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mật khẩu</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-primary/40 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-primary/40 text-sm">
            </div>

            <button style="background: rgb(29 78 216 / var(--tw-bg-opacity, 1));" type="submit" class="w-full py-2 bg-primary text-white rounded-lg transition">
                <i class="fa-solid fa-user-check mr-1"></i> Đăng ký
            </button>

            <p class="text-center text-sm text-gray-500 dark:text-gray-400 mt-3">
                Đã có tài khoản?
                <a href="{{ route('user.login') }}" class="text-primary hover:underline">Đăng nhập ngay</a>
            </p>
        </form>
    </div>
</body>

</html>