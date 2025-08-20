<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-xl shadow-lg p-6 md:col-span-3">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-3 rounded-full shadow-md">
                        <i class="fas fa-link text-indigo-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white tracking-wide">
                        BUAT SHORTLINK
                    </h3>
                </div>
            </div>
        </div>
    </div>
    @livewire('alert')

    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <form wire:submit.prevent="createShortLink" class="space-y-4">
            <!-- Input URL Asli -->
            <div>
                <label for="original_url" class="block text-sm font-medium text-gray-700 mb-1">
                    URL Asli
                </label>
                <input wire:model="original_url" id="original_url" type="url" placeholder="https://contoh.com/artikel"
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-700">
                @error('original_url')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="alias" class="block text-sm font-medium text-gray-700">Alias</label>
                <input type="text" id="alias" wire:model.defer="alias" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-700"
                    placeholder="contoh: wanara123">
                @error('alias')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="group relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-link mr-2"></i> Buat Link
                </button>
            </div>
        </form>
    </div>


    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <div class="mb-4 grid grid-cols-1 sm:grid-cols-3 gap-3 items-center">
            <!-- Input pencarian -->
            <div class="col-span-2">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Tahun Akademik..."
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-700" />
            </div>

            <!-- Tombol tambah / filter -->
            {{-- <div>
                <button
                    class="w-full sm:w-auto px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow">
                    + Tambah
                </button>
            </div> --}}
        </div>



        <div class="relative overflow-x-auto rounded-lg border border-gray-300 shadow-md">
            <!-- Overlay Loading -->
            <div wire:loading wire:target="search"
                class="absolute inset-0 bg-white/70 flex items-center justify-center z-10">
                <svg class="animate-spin h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                <span class="ml-2 text-indigo-600 font-semibold">Memuat data...</span>
            </div>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alias</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Link Pendek</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">URL Asli</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dibuat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($shortlinks as $index => $link)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-semibold text-indigo-600">
                            {{ $link->alias }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ url('/'.$link->alias) }}" target="_blank" class="text-blue-600 hover:underline">
                                {{ url('/'.$link->alias) }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            <a href="{{ $link->original_url }}" target="_blank" class="hover:underline">
                                {{ Str::limit($link->original_url, 40) }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $link->created_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="delete({{ $link->id }})"
                                class="inline-flex items-center justify-center w-8 h-8 bg-red-600 hover:bg-red-800 text-white text-sm font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-150 ease-in-out">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data shortlink</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Paginasi -->
        <div class="mt-7 bg-white">
            {{ $shortlinks->links() }}
        </div>

    </div>
</div>