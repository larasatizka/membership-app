@extends('layouts.app')

@section('content')
<div class="min-h-screen flex bg-gradient-to-br from-white via-indigo-50 to-indigo-100 relative">

    <!-- Background pattern SVG -->
    <div class="absolute inset-0 bg-[url('https://www.toptal.com/designers/subtlepatterns/uploads/double-bubble-outline.png')] opacity-5 z-0"></div>

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg border-r z-10 hidden md:block">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-indigo-600">MyDashboard</h2>
        </div>
        <nav class="p-4 space-y-4 text-gray-700">
            <a href="#" class="flex items-center gap-3 hover:text-indigo-600 transition">
                🏠 Dashboard
            </a>
            <a href="#" class="flex items-center gap-3 hover:text-indigo-600 transition">
                📚 Artikel
            </a>
            <a href="#" class="flex items-center gap-3 hover:text-indigo-600 transition">
                🎬 Video
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 z-10 relative">
        <h1 class="text-3xl font-bold mb-4">Halo, {{ $user->name }} 👋</h1>

        <div class="mb-6">
            @php
                $membershipColors = [
                    'A' => 'bg-green-100 text-green-800',
                    'B' => 'bg-yellow-100 text-yellow-800',
                    'C' => 'bg-red-100 text-red-800'
                ];
            @endphp
            <span class="inline-block px-4 py-2 rounded-full {{ $membershipColors[$user->membership] ?? 'bg-gray-100 text-gray-800' }}">
                Membership: <strong>{{ $user->membership }}</strong>
            </span>
            <button onclick="openModal()" class="text-sm text-indigo-600 hover:underline">
                Edit Membership
            </button>
        </div>

        <!-- Statistik Section -->
        <div class="bg-white p-6 rounded-2xl shadow mb-10">
            <h2 class="text-xl font-bold mb-4">📊 Statistik</h2>
            <div class="max-w-md mx-auto">
                <canvas id="statChart" style="height: 200px;"></canvas>
            </div>
        </div>

        <!-- Artikel -->
        <h2 class="text-2xl font-semibold mb-4">📚 Artikel Pilihan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($articles as $article)
            <div class="bg-white shadow-md hover:shadow-xl transition rounded-2xl p-6 border hover:border-indigo-400">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $article->title }}</h3>
                <p class="text-gray-600 text-sm">{{ Str::limit($article->content, 100) }}</p>
                <a href="#" class="mt-4 inline-block text-sm text-indigo-600 hover:text-indigo-800 font-medium transition">
                    Baca selengkapnya →
                </a>
            </div>
            @endforeach
        </div>

        <!-- Video -->
        <h2 class="text-2xl font-semibold mt-12 mb-4">🎬 Video Edukasi</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($videos as $video)
            <div class="bg-white shadow-md hover:shadow-xl transition rounded-2xl overflow-hidden">
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-full" src="{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $video->title }}</h3>
                </div>
            @endforeach
        </div>
    </main>
</div>

<!-- Modal -->
<div id="membershipModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-lg">
        <h2 class="text-lg font-bold mb-4">Edit Membership</h2>
        <form method="POST" action="{{ route('membership.update') }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="membership" class="block text-sm font-medium text-gray-700">Pilih Membership:</label>
                <select name="membership" id="membership" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="A" {{ $user->membership == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ $user->membership == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ $user->membership == 'C' ? 'selected' : '' }}>C</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal()" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Simpan</button>
            </div>
        </form>
    </div>
</div>


<!-- Chart.js Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('statChart').getContext('2d');
    const statChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Artikel', 'Video', 'User Aktif'],
            datasets: [{
                label: 'Jumlah',
                data: [{{ count($articles) }}, {{ count($videos) }}, 1],
                backgroundColor: [
                    'rgba(99, 102, 241, 0.6)',
                    'rgba(34, 197, 94, 0.6)',
                    'rgba(251, 191, 36, 0.6)'
                ],
                borderColor: [
                    'rgba(99, 102, 241, 1)',
                    'rgba(34, 197, 94, 1)',
                    'rgba(251, 191, 36, 1)'
                ],
                borderWidth: 1,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
});

function openModal() {
    document.getElementById('membershipModal').classList.remove('hidden');
    document.getElementById('membershipModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('membershipModal').classList.add('hidden');
}
</script>
@endsection
