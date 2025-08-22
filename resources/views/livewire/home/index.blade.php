<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="flex items-center justify-center  bg-gray-100">
        <div class="bg-white shadow-lg rounded-2xl p-8 max-w-screen text-center">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Selamat Datang di <span
                    class="text-indigo-600">WanaLink</span></h1>
            <p class="text-gray-600 mb-6">
                Buat dan kelola shortlink kamu dengan mudah.
                Silakan login terlebih dahulu untuk menggunakan fitur ini.
            </p>

            <a href="{{ route('login') }}"
                class="px-6 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                Login Sekarang
            </a>

            <p class="mt-4 text-sm text-gray-500">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-indigo-600 font-medium hover:underline">Daftar di sini</a>
            </p>
        </div>
    </div>

</div>