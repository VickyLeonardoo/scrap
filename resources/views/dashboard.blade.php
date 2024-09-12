<x-app-layout>
    @php
        $shopCount = App\Models\Shop::count();
        $twoMinutesAgo = Carbon\Carbon::now()->subMinutes(2);
        $onlineEmployees = App\Models\User::where('last_seen', '>=', $twoMinutesAgo)->get();
        $onlineEmployeesCount = $onlineEmployees->count();
    @endphp

    <div class="py-12 bg-gradient-to-br from-red-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard ScrapeToko</h1>

            <div class="grid md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-red-100 transition duration-300 hover:shadow-xl">
                    <div class="p-6 flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-700 mb-2">Jumlah Toko</h2>
                            <p class="text-4xl font-bold text-red-600">{{ number_format($shopCount) }}</p>
                        </div>
                        <div class="text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-red-100 transition duration-300 hover:shadow-xl">
                    <div class="p-6 flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-700 mb-2">Karyawan Online</h2>
                            <p id="online-employees-count" class="text-4xl font-bold text-red-600">{{ $onlineEmployeesCount }}</p>
                        </div>
                        <div class="text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-red-100">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Karyawan Online</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-red-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-red-600 uppercase tracking-wider">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-red-600 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-red-600 uppercase tracking-wider">
                                        Peran
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-red-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="users-table-body" class="bg-white divide-y divide-gray-200">
                                @foreach($onlineEmployees as $employee)
                                    <tr class="hover:bg-red-50 transition duration-300">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ $employee->name }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $employee->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $employee->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ ucfirst($employee->role) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Online
                                            </span>
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
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function fetchUserStatuses() {
            fetch('{{ route("users.statuses") }}')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('users-table-body');
                    tableBody.innerHTML = '';
                    let onlineCount = 0;
                    data.forEach(user => {
                        if (user.is_online) {
                            onlineCount++;
                            const row = document.createElement('tr');
                            row.id = `user-${user.id}`;
                            row.className = 'hover:bg-red-50 transition duration-300';

                            const userRole = capitalizeFirstLetter(user.role);

                            row.innerHTML = `
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&color=7F9CF5&background=EBF4FF" alt="${user.name}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">${user.name}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">${user.email}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">${userRole}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Online
                                    </span>
                                </td>
                            `;

                            tableBody.appendChild(row);
                        }
                    });
                    document.getElementById('online-employees-count').textContent = onlineCount;
                });
        }

        setInterval(fetchUserStatuses, 5000); // Polling setiap 5 detik
    </script>
</x-app-layout>