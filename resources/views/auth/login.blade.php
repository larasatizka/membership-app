<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .circle {
            @apply absolute rounded-full blur-3xl opacity-30 pointer-events-none;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-400 via-blue-300 to-pink-200 overflow-hidden relative px-4">

    <!-- Decorative blurred circles -->
    <div class="circle w-96 h-96 bg-purple-300 top-[-50px] left-[-50px]"></div>
    <div class="circle w-80 h-80 bg-pink-300 bottom-[-60px] right-[-40px]"></div>
    <div class="circle w-72 h-72 bg-blue-200 top-1/3 left-1/2 transform -translate-x-1/2"></div>

    <!-- Login Card -->
    <div class="relative z-10 bg-white/90 backdrop-blur-md shadow-2xl rounded-2xl w-full max-w-md p-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Login ke Akun Anda</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                Login
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-500">
            Belum punya akun?
            <a href="{{ route('register.form') }}" class="text-indigo-600 hover:underline font-medium">Daftar</a>
        </div>

        <div class="mt-6">
            <p class="text-center text-gray-500 text-sm mb-3">Atau login dengan</p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('login.google') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition text-sm">
                    Google
                </a>
                <a href="{{ route('login.facebook') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">
                    Facebook
                </a>
            </div>
        </div>
    </div>

</body>
</html>
