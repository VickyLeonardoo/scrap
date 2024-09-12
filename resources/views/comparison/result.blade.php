<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-red-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl border border-red-100 overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-8">
                        <a href="{{ route('comparison.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                            ← Kembali
                        </a>
                        <h1 class="text-3xl font-bold text-gray-800">Hasil Perbandingan Toko</h1>
                        <form action="{{ route('comparison.compare') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="shop1_id" value="{{ $shop1->id }}">
                            <input type="hidden" name="shop2_url" value="{{ request('shop2_url') }}">
                            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                            <input type="hidden" name="page1" value="{{ $shop1_data['current_page'] }}">
                            <input type="hidden" name="page2" value="{{ $shop2_data['current_page'] }}">
                            <select name="sort" onchange="this.form.submit()" class="bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-full focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50 text-sm">
                                <option value="23" {{ $current_sort == '23' ? 'selected' : '' }}>Relevan</option>
                                <option value="2" {{ $current_sort == '2' ? 'selected' : '' }}>Terbaru</option>
                                <option value="10" {{ $current_sort == '10' ? 'selected' : '' }}>Harga Tertinggi</option>
                                <option value="9" {{ $current_sort == '9' ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="11" {{ $current_sort == '11' ? 'selected' : '' }}>Ulasan Terbanyak</option>
                                <option value="8" {{ $current_sort == '8' ? 'selected' : '' }}>Pembelian Terbanyak</option>
                                <option value="5" {{ $current_sort == '5' ? 'selected' : '' }}>Dilihat Terbanyak</option>
                                <option value="3" {{ $current_sort == '3' ? 'selected' : '' }}>Pembaruan Terakhir</option>
                            </select>
                        </form>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        @foreach (['shop1_data', 'shop2_data'] as $index => $shop_data)
                            <div class="flex flex-col h-[calc(100vh-12rem)] bg-gray-50 rounded-lg shadow-md overflow-hidden">
                                <div class="p-4 bg-white border-b flex justify-between items-center">
                                    <h2 class="text-xl font-semibold text-gray-800">{{ ${$shop_data}['shop_name'] }}</h2>
                                    <div class="flex space-x-2">
                                        @if (${$shop_data}['prev_page'])
                                            <form action="{{ route('comparison.compare') }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="shop1_id" value="{{ $shop1->id }}">
                                                <input type="hidden" name="shop2_url" value="{{ request('shop2_url') }}">
                                                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                                                <input type="hidden" name="{{ $index === 0 ? 'page1' : 'page2' }}" value="{{ ${$shop_data}['current_page'] - 1 }}">
                                                <input type="hidden" name="sort" value="{{ $current_sort }}">
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-150 ease-in-out text-sm">
                                                    ← Sebelumnya
                                                </button>
                                            </form>
                                        @endif
                                        @if (${$shop_data}['next_page'])
                                            <form action="{{ route('comparison.compare') }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="shop1_id" value="{{ $shop1->id }}">
                                                <input type="hidden" name="shop2_url" value="{{ request('shop2_url') }}">
                                                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                                                <input type="hidden" name="{{ $index === 0 ? 'page1' : 'page2' }}" value="{{ ${$shop_data}['current_page'] + 1 }}">
                                                <input type="hidden" name="sort" value="{{ $current_sort }}">
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-150 ease-in-out text-sm">
                                                    Selanjutnya →
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1 overflow-y-auto p-4">
                                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                        @forelse (${$shop_data}['products'] as $product)
                                            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                                                <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" class="w-full h-32 object-cover">
                                                <div class="p-3">
                                                    <a href="{{ $product['link'] }}" target="_blank" class="text-red-600 hover:text-red-800 font-semibold text-xs mb-1 block">{{ Str::limit($product['title'], 40) }}</a>
                                                    <div class="text-gray-800 font-bold text-sm mb-1">{{ $product['price'] }}</div>
                                                    <div class="flex items-center mb-1">
                                                        <svg class="w-3 h-3 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                        <span class="text-xs text-gray-600">{{ $product['rating'] }}</span>
                                                    </div>
                                                    <div class="text-green-600 text-xs">{{ $product['sold'] }}</div>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="col-span-4 text-center text-gray-500">Tidak ada produk ditemukan untuk toko ini.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>