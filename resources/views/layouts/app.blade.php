<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <nav class="bg-white shadow-md py-4 mb-6">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <div class="text-xl font-bold">MyApp</div>
            <div>
                <span class="mr-4">Hi, {{ Auth::user()->name }}</span>
                <a href="{{ route('logout') }}"
                   class="text-red-500 hover:text-red-700"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>
