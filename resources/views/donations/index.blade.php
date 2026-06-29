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
                        Daftar Data Donasi
                    </h3>

                    <a href="{{ route('donations.create') }}"
                        class="px-4 py-2 font-semibold bg-green-600 text-white rounded hover:bg-green-700">
                        + Tambah Data Donasi
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300">

                        <thead class="bg-green-50 text-green-700">
                            <tr>
                                <th class="border px-4 py-2 text-left">No</th>
                                <th class="border px-4 py-2 text-left">Tanggal Donasi</th>
                                <th class="border px-4 py-2 text-left">Nama Donatur</th>
                                <th class="border px-4 py-2 text-left">Perubahan Oleh</th>
                                <th class="border px-4 py-2 text-left">Jumlah Produk</th>
                                <th class="border px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($donations as $key => $donation)
                            <tr>
                                <td class="border px-4 py-2">
                                    {{ $donations->firstItem() + $key }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ $donation->donation_date }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ $donation->donor_name }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ $donation->user->name ?? '-' }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ $donation->details->count() }}
                                </td>

                                <td class="border px-4 py-2">
                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('donations.show', $donation->id) }}"
                                            class="px-3 py-1 font-semibold bg-blue-500 text-white rounded hover:bg-blue-600">
                                            Detail
                                        </a>

                                        <form action="{{ route('donations.destroy', $donation->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data donasi ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="px-3 py-1 font-semibold bg-red-600 text-white rounded hover:bg-red-700">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>
                                </td>
                            </tr>

                            @empty

                            <tr>
                                <td colspan="6" class="border px-4 py-2 text-center text-gray-500">
                                    Belum ada data donasi.
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>

                <div class="mt-4">
                    {{ $donations->links() }}
                </div>

            </div>

        </div>
    </div>

</x-app-layout>