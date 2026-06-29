<x-app-layout>

    <x-slot name="header">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white/70 backdrop-blur-md rounded-xl px-6 py-4 shadow">
                <h2 class="font-semibold text-xl text-green-800 leading-tight">
                    {{ __('Tambah Data Produksi') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-blue-100 shadow-sm sm:rounded-lg p-6 bg-gradient-to-b from-white to-[#CDFFC7]">

                @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('productions.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">
                            Tanggal Produksi
                        </label>

                        <input type="date" name="production_date"
                            value="{{ old('production_date', date('Y-m-d')) }}"
                            class="w-full border rounded px-3 py-2 bg-white focus:ring-green-500 focus:border-green-500">

                        @error('production_date')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                        <div>
                            <label class="block font-medium mb-1 text-gray-700">
                                Nama Produk
                            </label>

                            <select name="product_id"
                                class="w-full border rounded px-3 py-2 bg-white focus:ring-green-500 focus:border-green-500">

                                <option value=""></option>

                                @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->product_name }}
                                </option>
                                @endforeach

                            </select>

                            @error('product_id')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium mb-1 text-gray-700">
                                Perubahan Oleh
                            </label>

                            <input type="text" value="{{ auth()->user()->name }}"
                                class="w-full border rounded px-3 py-2 bg-gray-100" readonly>
                        </div>

                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-1 text-gray-700">
                            Quantity Produksi
                        </label>

                        <input type="number" name="quantity" min="1"
                            value="{{ old('quantity', 1) }}"
                            class="w-full border rounded px-3 py-2 bg-white font-medium focus:ring-green-500 focus:border-green-500">

                        @error('quantity')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex gap-2">

                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition font-medium">
                            Simpan Data Produksi
                        </button>

                        <a href="{{ route('productions.index') }}"
                            class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition font-medium">
                            Kembali
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>