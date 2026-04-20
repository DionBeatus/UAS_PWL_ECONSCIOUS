<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pembelian') }}
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
                    <h3 class="text-lg font-bold">Daftar Pembelian</h3>
                    <a href="{{ route('purchases.create') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Tambah Pembelian
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left">No</th>
                                <th class="border px-4 py-2 text-left">Tanggal Pembelian</th>
                                <th class="border px-4 py-2 text-left">Nama Store</th>
                                <th class="border px-4 py-2 text-left">Nama Pembeli</th>
                                <th class="border px-4 py-2 text-left">Nama Produk</th>
                                <th class="border px-4 py-2 text-left">Jumlah</th>
                                <th class="border px-4 py-2 text-left">Harga</th>
                                <th class="border px-4 py-2 text-left">Total</th>
                                <th class="border px-4 py-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($purchases as $key => $purchase)
                            <tr>
                                <td class="border px-4 py-2">{{ $purchases->firstItem() + $key }}</td>
                                <td class="border px-4 py-2">{{ $purchase->purchase_date }}</td>
                                <td class="border px-4 py-2">{{ $purchase->store_name }}</td>
                                <td class="border px-4 py-2">{{ $purchase->user->name ?? '-'}}</td>
                                <td class="border px-4 py-2">{{ $purchase->product->name ?? '-'}}</td>
                                <td class="border px-4 py-2">{{ $purchase->quantity }}</td>
                                <td class="border px-4 py-2">{{ $purchase->price }}</td>
                                <td class="border px-4 py-2">{{ $purchase->total }}</td>

                                <td class="border px-4 py-2">

                                    <a href="{{ route('purchases.edit', $purchase->id) }}"
                                        class="px-3 py-1 bg-yellow-500 text-white rounded">
                                        Edit
                                    </a>

                                    <form action="{{ route('purchases.destroy', $purchase->id) }}"
                                        method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Yakin hapus data pembelian ini?')">
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
                                <td colspan="9" class="border px-4 py-2 text-center">
                                    Belum ada data pembelian.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $purchases->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>