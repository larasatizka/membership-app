<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Membership App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-xl w-full max-w-md p-8">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Login to Your Account</h2>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required autofocus
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex justify-between items-center">
                <label class="flex items-center text-sm">
                    <input type="checkbox" name="remember" class="mr-2">
                    Remember me
                </label>
                <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                Login
            </button>
        </form>

        <div class="my-6 flex items-center justify-between">
            <span class="border-t w-1/5 lg:w-1/4"></span>
            <span class="text-xs text-center text-gray-500 uppercase">or login with</span>
            <span class="border-t w-1/5 lg:w-1/4"></span>
        </div>

        <div class="flex space-x-4 justify-center">
            <a href="{{ url('login/google') }}"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded flex items-center">
                <svg class="h-5 w-5 mr-2" viewBox="0 0 48 48"><path fill="#fff" d="M44.5 20H24v8.5h11.8C34 33 30 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3.2 0 6 .8 8.1 2.6l6-6C34.2 5.5 29.4 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.7-.5-4z"/></svg>
                Google
            </a>
            <a href="{{ url('login/facebook') }}"
                class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded flex items-center">
                <svg class="h-5 w-5 mr-2" viewBox="0 0 48 48"><path fill="#fff" d="M24 4C12.9 4 4 12.9 4 24c0 9.9 7.2 18 16.5 19.8v-14h-5v-5.8h5V18c0-4.9 3-7.7 7.5-7.7 2.2 0 4.5.4 4.5.4v5h-2.5c-2.5 0-3.3 1.5-3.3 3v3.6h5.6l-.9 5.8h-4.7v14C36.8 42 44 33.9 44 24c0-11.1-8.9-20-20-20z"/></svg>
                Facebook
            </a>
        </div>

        <p class="mt-6 text-sm text-center text-gray-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
        </p>
    </div>
</body>
</html>
