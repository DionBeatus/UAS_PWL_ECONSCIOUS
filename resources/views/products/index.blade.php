<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Stock') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Daftar Stock</h3>
                    <a href="{{ route('products.create') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Tambah Produk
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left">No</th>
                                <th class="border px-4 py-2 text-left">Nama Produk</th>
                                <th class="border px-4 py-2 text-left">Stock</th>
                                <th class="border px-4 py-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $key => $product)
                            <tr>
                                <td class="border px-4 py-2">{{ $products->firstItem() + $key }}</td>
                                <td class="border px-4 py-2">{{ $product->product_name }}</td>
                                <td class="border px-4 py-2">{{ $product->stock }}</td>

                                <td class="border px-4 py-2">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="px-3 py-1 bg-yellow-500 text-white rounded">
                                        Edit
                                    </a>

                                    <form action="{{ route('products.destroy', $product->id) }}"
                                        method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Yakin hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 bg-red-600 text-white rounded">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="border px-4 py-2 text-center">
                                    Belum ada data stock.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>