<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-red-50 to-white min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Bandingkan Toko Tokopedia</h1>
            <div class="bg-white shadow-lg rounded-xl border border-red-100 overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('comparison.compare') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="shop1_id" :value="__('Toko 1')" class="text-gray-700" />
                                <select name="shop1_id" id="shop1_id" class="block mt-1 w-full rounded-md border-gray-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50" required>
                                    <option value="">Pilih toko</option>
                                    @foreach($shops as $shop)
                                        <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="shop2_url" :value="__('URL Toko 2')" class="text-gray-700" />
                                <x-text-input id="shop2_url" class="block mt-1 w-full rounded-md border-gray-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50" type="url" name="shop2_url" required placeholder="https://www.tokopedia.com/namatoko" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="keyword" :value="__('Kata Kunci Pencarian')" class="text-gray-700" />
                            <x-text-input id="keyword" class="block mt-1 w-full rounded-md border-gray-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50" type="text" name="keyword" required placeholder="contoh: Kaos Kaki" />
                        </div>

                        <div>
                            <x-input-label for="sort" :value="__('Urutkan Berdasarkan')" class="text-gray-700" />
                            <select name="sort" id="sort" class="block mt-1 w-full rounded-md border-gray-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                <option value="23">Relevan</option>
                                <option value="2">Terbaru</option>
                                <option value="10">Harga Tertinggi</option>
                                <option value="9">Harga Terendah</option>
                                <option value="11">Ulasan Terbanyak</option>
                                <option value="8">Pembelian Terbanyak</option>
                                <option value="5">Dilihat Terbanyak</option>
                                <option value="3">Pembaruan Terakhir</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="bg-red-600 hover:bg-red-700">
                                {{ __('Bandingkan Toko') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>