<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-red-50 to-white min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Pengguna</h1>
            <div class="bg-white shadow-lg rounded-xl border border-red-100 overflow-hidden">
                <div class="p-6">
                    <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Nama')" class="text-gray-700" />
                            <x-text-input id="name" class="block mt-1 w-full rounded-md border-gray-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                            <x-text-input id="email" class="block mt-1 w-full rounded-md border-gray-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50" type="email" name="email" :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="role" :value="__('Peran')" class="text-gray-700" />
                            <select id="role" name="role" class="block mt-1 w-full rounded-md border-gray-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50" required>
                                <option value="" disabled selected>Pilih Peran</option>
                                <option value="karyawan">Karyawan</option>
                                <option value="admin">Admin</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Kata Sandi')" class="text-gray-700" />
                            <x-text-input id="password" class="block mt-1 w-full rounded-md border-gray-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50" type="password" name="password" required />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-gray-700" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-md border-gray-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50" type="password" name="password_confirmation" required />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 mr-4">
                                Kembali
                            </a>
                            <x-primary-button class="bg-red-600 hover:bg-red-700">
                                {{ __('Tambah') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>