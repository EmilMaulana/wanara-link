<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="space-y-6">
        {{-- Header Card --}}
        <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-xl shadow-lg p-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
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

        @livewire('alert')

        {{-- Form --}}
        <div class="bg-white rounded-xl shadow-md p-6">
            <form wire:submit.prevent="createShortLink" class="space-y-4">
                <div>
                    <label for="original_url" class="block text-sm font-medium text-gray-700 mb-1">
                        URL Asli
                    </label>
                    <input wire:model="original_url" id="original_url" type="url"
                        placeholder="https://contoh.com/artikel"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    @error('original_url')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="alias" class="block text-sm font-medium text-gray-700">Alias</label>
                    <input type="text" id="alias" wire:model.defer="alias" required placeholder="contoh: wanara123"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    @error('alias')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
                        <i class="fas fa-link mr-2"></i> Buat Link
                    </button>
                </div>
            </form>
        </div>

        {{-- Tabel Data --}}
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="mb-4 flex flex-col sm:flex-row gap-3">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Tahun Akademik..."
                    class="flex-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div class="relative overflow-x-auto rounded-lg border border-gray-300 shadow-md">
                <div wire:loading wire:target="search"
                    class="absolute inset-0 bg-white/70 flex items-center justify-center z-10">
                    <svg class="animate-spin h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
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
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-semibold text-indigo-600">{{ $link->alias }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ url('/'.$link->alias) }}" target="_blank"
                                    class="text-blue-600 hover:underline">
                                    {{ url('/'.$link->alias) }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <a href="{{ $link->original_url }}" target="_blank" class="hover:underline">
                                    {{ Str::limit($link->original_url, 40) }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $link->created_at->diffForHumans() }}
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="delete({{ $link->id }})"
                                    class="w-8 h-8 bg-red-600 hover:bg-red-800 text-white rounded-lg flex items-center justify-center">
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

            <div class="mt-7">
                {{ $shortlinks->links() }}
            </div>
        </div>
    </div>

</div>