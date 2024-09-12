<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-red-50 to-white min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Toko</h1>
            <div class="bg-white shadow-lg rounded-xl border border-red-100 overflow-hidden">
                <div class="p-6">
                    <form method="POST" action="{{ route('shops.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="link" :value="__('Link Toko')" class="text-gray-700" />
                            <x-text-input id="link" class="block mt-1 w-full rounded-md border-gray-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50" type="url" name="link" :value="old('link')" required autofocus />
                            <x-input-error :messages="$errors->get('link')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('shops.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 mr-4">
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