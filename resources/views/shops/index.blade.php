<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-red-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Toko</h1>
            <div class="bg-white shadow-lg rounded-xl border border-red-100 overflow-hidden">
                <div class="p-6">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                        <a href="{{ route('shops.create') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 flex items-center mb-4 md:mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Tambah Toko
                        </a>
                    </div>

                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                            <thead>
                                <tr class="text-left">
                                    <th class="bg-red-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">Nama Toko</th>
                                    <th class="bg-red-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">Link</th>
                                    <th class="bg-red-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shops as $shop)
                                    <tr class="hover:bg-red-50 transition-colors duration-200">
                                        <td class="border-b border-gray-200 px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($shop->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ $shop->name }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $shop->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-b border-gray-200 px-6 py-4">
                                            <a href="{{ $shop->link }}" target="_blank" class="text-blue-600 hover:text-blue-900">{{ $shop->link }}</a>
                                        </td>
                                        <td class="border-b border-gray-200 px-6 py-4">
                                            <a href="{{ route('shops.edit', $shop) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                                            <form action="{{ route('shops.destroy', $shop) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus toko ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>