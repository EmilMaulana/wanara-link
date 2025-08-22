<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Wanara Link' }}</title>

    <!-- Tailwind CSS CDN -->
    {{-- @vite('resources/css/app.css') --}}
    <!-- Font Awesome untuk ikon -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body class="bg-slate-100 text-gray-800">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed w-64 bg-white shadow-lg z-50 
           transform -translate-x-full md:translate-x-0 md:relative md:flex md:flex-col overflow-hidden">
            <div class="flex items-center justify-center h-20 bg-indigo-600 shadow-md">
                <span class="text-xl font-extrabold text-white logo-text">Wanara Link</span>
            </div>

            <nav class="flex-1 px-4 py-6 overflow-y-auto">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center p-3 rounded-lg transition duration-200 {{ request()->routeIs('dashboard') ? 'text-indigo-600 bg-indigo-50 hover:bg-indigo-100' : 'text-gray-700 hover:bg-gray-100 hover:text-indigo-600' }}">
                            <i class="fas fa-home fa-fw mr-3 text-md"></i>
                            <span class="font-medium nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('shortlink.index') }}"
                            class="flex items-center p-3 rounded-lg transition duration-200 {{ request()->routeIs('shortlink.*') ? 'text-indigo-600 bg-indigo-50 hover:bg-indigo-100' : 'text-gray-700 hover:bg-gray-100 hover:text-indigo-600' }}">
                            <i class="fas fa-link fa-fw mr-3 text-md"></i>
                            <span class="font-medium nav-text">Short Link</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Tombol Collapse untuk Desktop -->
            <div class="p-4 border-t border-gray-200 hidden md:block">
                <button id="collapse-btn"
                    class="w-full flex items-center justify-center p-2 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-indigo-600 transition-colors duration-200">
                    <i id="collapse-icon" class="fas fa-chevron-left transition-transform duration-300"></i>
                </button>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div id="main-content" class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header
                class="flex items-center justify-between h-20 bg-white shadow-md px-6 z-40 fixed top-0 left-0 right-0">
                <div class="flex items-center">
                    <button id="sidebar-toggle" class="text-gray-500 focus:outline-none focus:text-gray-700 md:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Semester Dropdown -->
                    <div class="relative group">
                    </div>

                    <!-- User Dropdown -->
                    @php
                    use Illuminate\Support\Facades\Auth;

                    $name = Auth::user()->name ?? 'Guest';
                    $initials = collect(explode(' ', $name))
                    ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                    ->join('');
                    @endphp

                    <div class="relative group">
                        <button class="flex items-center text-gray-600 hover:text-indigo-600 focus:outline-none">
                            <img src="https://placehold.co/40x40/e2e8f0/334155?text={{ $initials }}" alt="User Avatar"
                                class="w-10 h-10 rounded-full border-2 border-indigo-500" />
                            <span class="ml-2 font-medium hidden sm:block">
                                {{ $name }}
                            </span>
                            <i class="fas fa-chevron-down ml-2 text-sm"></i>
                        </button>

                        <div
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform scale-95 group-hover:scale-100 origin-top-right">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Pengaturan</a>
                            <div class="border-t border-gray-200 my-1"></div>
                            {{-- <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Keluar</a> --}}

                            <livewire:dashboard.logout />
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 p-6 bg-slate-100 pt-24">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white text-center p-4 text-sm text-gray-500">
                &copy; 2025 WanaLink by Wanara Digital. Hak Cipta Dilindungi.
            </footer>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dapatkan semua alert yang memiliki ID 'success-alert' atau 'error-alert'
            const alerts = document.querySelectorAll('#success-alert, #error-alert');
        
            alerts.forEach(alert => {
                // Sembunyikan alert secara otomatis setelah 3 detik
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.style.display = 'none', 500); // Tunggu transisi selesai sebelum menyembunyikan
                }, 3000);
        
                // Tambahkan event listener untuk tombol tutup
                const closeButton = alert.querySelector('.close-alert-btn');
                if (closeButton) {
                    closeButton.addEventListener('click', () => {
                        alert.style.opacity = '0';
                        setTimeout(() => alert.style.display = 'none', 500);
                    });
                }
            });
        });
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>