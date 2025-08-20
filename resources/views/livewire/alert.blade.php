<div>
    @if (session()->has('successMessage') || session()->has('errorMessage'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition.opacity
        class="fixed top-5 right-5 z-50">
        <div
            class="flex items-center space-x-3 px-4 py-3 rounded-lg shadow-lg 
                {{ session()->has('successMessage') ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }}">

            <!-- Icon -->
            @if (session()->has('successMessage'))
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 
                            11-18 0 9 9 0 0118 0z" />
            </svg>
            @endif
            @if (session()->has('errorMessage'))
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856
                            c1.54 0 2.502-1.667 1.732-3L13.732 4
                            c-.77-1.333-2.694-1.333-3.464 0L3.34 
                            16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            @endif

            <!-- Isi Pesan -->
            <div class="flex-1">
                <p class="font-semibold text-gray-800">
                    {{ session()->has('successMessage') ? 'Berhasil!' : 'Gagal!' }}
                </p>
                <p class="text-sm text-gray-600">
                    {{ session('successMessage') ?? session('errorMessage') }}
                </p>
            </div>

            <!-- Tombol Close -->
            <button @click="show = false" class="text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    @endif
</div>