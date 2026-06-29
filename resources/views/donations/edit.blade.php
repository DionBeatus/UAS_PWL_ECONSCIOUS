<x-app-layout>

    <x-slot name="header">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white/70 backdrop-blur-md rounded-xl px-6 py-4 shadow">
                <h2 class="font-semibold text-xl text-green-800 leading-tight">
                    {{ __('Edit Data Donasi') }}
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

                <form action="{{ route('donations.update', $donation->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Nama Donatur</label>

                        <input type="text" name="donor_name" value="{{ old('donor_name', $donation->donor_name) }}"
                            class="w-full border rounded px-3 py-2 bg-gray-100 focus:ring-green-500 focus:border-green-500" readonly>

                        @error('donor_name')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block font-medium mb-1 text-gray-700">Tanggal Donasi</label>

                            <input type="date" name="donation_date"
                                value="{{ old('donation_date', $donation->donation_date) }}"
                                class="w-full border rounded px-3 py-2 bg-white focus:ring-green-500 focus:border-green-500">

                            @error('donation_date')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium mb-1 text-gray-700">Perubahan Oleh</label>

                            <input type="text" value="{{ auth()->user()->name }}"
                                class="w-full border rounded px-3 py-2 bg-gray-100" readonly>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-2 text-gray-700">Produk Donasi</label>

                        <div id="product-container" class="space-y-3">

                            @foreach($donation->details as $index => $detail)
                                <div class="flex flex-wrap md:flex-nowrap gap-2 items-center bg-white p-3 rounded-lg border border-green-100 product-row">

                                    <div class="flex-1">
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Pilih Produk</label>

                                        <select name="products[]" class="w-full border rounded px-3 py-2 bg-white">
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ old('products.' . $index, $detail->product_id) == $product->id ? 'selected' : '' }}>
                                                    {{ $product->product_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="w-36">
                                        <label class="block text-xs font-medium text-gray-500 mb-1 text-center">Quantity</label>

                                        <input type="number" name="quantities[]" min="1"
                                            value="{{ old('quantities.' . $index, $detail->quantity) }}"
                                            class="w-full border rounded px-3 py-2 text-center bg-white">
                                    </div>

                                    <div class="pt-5">
                                        <button type="button"
                                            class="px-3 py-2 bg-red-500 font-semibold text-white rounded hover:bg-red-600 text-sm remove-row">
                                            Hapus
                                        </button>
                                    </div>

                                </div>
                            @endforeach

                        </div>

                        <button type="button" id="add-product"
                            class="mt-3 px-3 py-1.5 bg-blue-600 text-white rounded text-sm font-medium hover:bg-blue-700 transition">
                            + Tambah Produk
                        </button>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition font-medium">
                            Simpan Perubahan
                        </button>

                        <a href="{{ route('donations.index') }}"
                            class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition font-medium">
                            Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-product').addEventListener('click', function () {
            let container = document.getElementById('product-container');
            let firstRow = document.querySelector('.product-row');

            let newRow = firstRow.cloneNode(true);

            newRow.querySelector('select').selectedIndex = 0;
            newRow.querySelector('input').value = 1;

            container.appendChild(newRow);
        });

        document.getElementById('product-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-row')) {
                let rows = document.querySelectorAll('.product-row');

                if (rows.length > 1) {
                    e.target.closest('.product-row').remove();
                } else {
                    alert('Minimal harus ada 1 produk.');
                }
            }
        });
    </script>

</x-app-layout>