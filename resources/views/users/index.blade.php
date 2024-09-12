<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-red-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Pengguna</h1>
            <div class="bg-white shadow-lg rounded-xl border border-red-100 overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                        <a href="{{ route('users.create') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 flex items-center mb-4 md:mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Tambah Pengguna
                        </a>
                        <form method="GET" action="{{ route('users.index') }}" class="flex w-full md:w-auto">
                            <input type="text" name="search" placeholder="Cari Pengguna" class="rounded-l-full w-full md:w-64 border-gray-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50" value="{{ request('search') }}">
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-r-full hover:bg-red-700 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>

                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                            <thead>
                                <tr class="text-left">
                                    <th class="bg-red-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">Nama</th>
                                    <th class="bg-red-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">Email</th>
                                    <th class="bg-red-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">Peran</th>
                                    <th class="bg-red-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">Status</th>
                                    <th class="bg-red-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="users-table-body">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-red-50 transition-colors duration-200">
                                        <td class="border-b border-gray-200 px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ $user->name }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $user->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-b border-gray-200 px-6 py-4">{{ $user->email }}</td>
                                        <td class="border-b border-gray-200 px-6 py-4">{{ ucfirst($user->role) }}</td>
                                        <td class="border-b border-gray-200 px-6 py-4" id="status-{{ $user->id }}">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Memuat...
                                            </span>
                                        </td>
                                        <td class="border-b border-gray-200 px-6 py-4">
                                            <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
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

    <script>
        function updateUserStatus(userId, isOnline) {
            const statusElement = document.getElementById(`status-${userId}`);
            if (statusElement) {
                statusElement.innerHTML = isOnline
                    ? '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Online</span>'
                    : '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Offline</span>';
            }
        }

        function fetchUserStatuses() {
            fetch('{{ route("users.statuses") }}')
                .then(response => response.json())
                .then(data => {
                    data.forEach(user => {
                        updateUserStatus(user.id, user.is_online);
                    });
                });
        }

        // Initial fetch
        fetchUserStatuses();

        // Set up polling
        setInterval(fetchUserStatuses, 5000);
    </script>
</x-app-layout>