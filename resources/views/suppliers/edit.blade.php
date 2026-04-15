<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pembelian') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nama Pembeli</label>
                        <input type="text" name="buyer_name" value="{{ old('buyer_name', $supplier->buyer_name) }}"
                            class="w-full border rounded px-3 py-2">
                        @error('buyer_name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nama Produk</label>
                        <input type="text" name="product_name" value="{{ old('product_name') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('product_name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Quantity</label>
                        <input type="number" name="quantity" value="{{ old('quantity', $supplier->quantity) }}"
                            class="w-full border rounded px-3 py-2">
                        @error('quantity')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Harga</label>
                        <input type="number" name="price" value="{{ old('price', $supplier->price) }}"
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
                            Update
                        </button>

                        <a href="{{ route('suppliers.index') }}"
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
            total.value = q * p;
        }

        qty.addEventListener('input', hitungTotal);
        price.addEventListener('input', hitungTotal);
    </script>
</x-app-layout>