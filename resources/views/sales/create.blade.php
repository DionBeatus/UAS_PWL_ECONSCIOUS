<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nama Customer</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('customer_name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Email</label>
                        <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('customer_email')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nama Produk</label>
                        <select name="product_name" class="w-full border rounded px-3 py-2">
                            <option value="EcoChain">EcoChain</option>
                        </select>
                        @error('product_name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Jumlah</label>
                        <input type="number" name="quantity" value="{{ old('quantity') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('quantity')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Harga</label>
                        <input type="number" name="price" value="{{ old('price') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('price')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Total</label>
                        <input type="number" name="total" id="total"
                            class="w-full border rounded px-3 py-2 bg-gray-100"
                            readonly>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Simpan
                        </button>

                        <a href="{{ route('sales.index') }}"
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const qty = document.querySelector('input[name="quantity"]');
        const price = document.querySelector('input[name="price"]');
        const total = document.getElementById('total');

        function hitungTotal() {
            let q = parseInt(qty.value) || 0;
            let p = parseInt(price.value) || 0;
            let t = Math.round(q * p);
            total.value = t;
        }

        qty.addEventListener('input', hitungTotal);
        price.addEventListener('input', hitungTotal);
    </script>

</x-app-layout>