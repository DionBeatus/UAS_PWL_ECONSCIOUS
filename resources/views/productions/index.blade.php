<x-app-layout>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg text-green-700 font-bold">
                        Daftar Produksi
                    </h3>

                    <a href="{{ route('productions.create') }}"
                        class="px-4 py-2 font-semibold bg-green-600 text-white rounded hover:bg-green-700">
                        + Tambah Produksi
                    </a>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full border border-gray-300">

                        <thead class="bg-green-50 text-green-700">
                            <tr>
                                <th class="border px-4 py-2 text-left">No</th>
                                <th class="border px-4 py-2 text-left">Tanggal Produksi</th>
                                <th class="border px-4 py-2 text-left">Perubahan Oleh</th>
                                <th class="border px-4 py-2 text-left">Nama Produk</th>
                                <th class="border px-4 py-2 text-left">Quantity</th>
                                <th class="border px-4 py-2 text-left">Jumlah Bahan</th>
                                <th class="border px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($productions as $key => $production)

                            <tr>

                                <td class="border px-4 py-2">
                                    {{ $productions->firstItem() + $key }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ $production->production_date }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ $production->user->name }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ $production->product->product_name }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ $production->quantity }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ $production->details->count() }}
                                </td>

                                <td class="border px-4 py-2">
                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('productions.show', $production->id) }}"
                                            class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 font-semibold">
                                            Detail
                                        </a>

                                        <form action="{{ route('productions.destroy', $production->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data produksi ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 font-semibold">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>
                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="7" class="border px-4 py-2 text-center text-gray-500">
                                    Belum ada data produksi.
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-4">
                    {{ $productions->links() }}
                </div>

            </div>

        </div>
    </div>

</x-app-layout>