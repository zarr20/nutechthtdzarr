<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden ">
                <div class="bg-white ">


                    <div class="flex justify-between items-center gap-3 mb-4">
                        <form action="{{ route('produk') }}" method="GET">
                            <div class="flex items-center gap-2">
                                <input type="text" name="search" placeholder="Cari produk..."
                                    class="border rounded-md py-2 px-3 w-auto focus:outline-none focus:border-indigo-500 text-xs">
                                <select name="kategori"
                                    class="border rounded-md py-2 px-3 w-auto focus:outline-none focus:border-indigo-500 text-xs">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                <button type="submit"
                                    class="bg-black hover:bg-slate-950 text-white font-semibold py-2 px-4 rounded-md focus:outline-none  text-xs">
                                    Cari
                                </button>
                            </div>
                        </form>

                        <div class="flex gap-3">

                            <a href="{{ route('produk.export', ['search' => request('search'), 'kategori' => request('kategori')]) }}"
                                class="bg-black hover:bg-slate-950 text-white font-semibold py-2 px-4 rounded-md focus:outline-none text-xs">
                                Ekspor ke Excel
                            </a>


                            <a href="{{ route('produk.add') }}"
                                class="bg-black hover:bg-slate-950 text-white font-semibold py-2 px-4 rounded-md focus:outline-none text-xs">
                                Tambah Produk
                            </a>

                        </div>

                    </div>

                    <table class="min-w-full table-auto text-sm">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Gambar
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Produk
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Harga Beli
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Harga Jual
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Stok
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $key => $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ $produk->firstItem() + $key }}</td>
                                    {{-- <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ $item->id }}</td> --}}
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <img src="{{ asset('storage/' . $item->gambar) }}"
                                            alt="{{ $item->nama_produk }}" class="w-16 h-16 object-cover rounded-full">
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ $item->nama_produk }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ $item->harga_beli }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ $item->harga_jual }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ $item->stok }}</td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ $item->kategori->nama_kategori }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <a href="{{ route('produk.edit', ['id' => $item->id]) }}"
                                            class="text-blue-500 hover:text-blue-700 mr-2">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('produk.delete', ['id' => $item->id]) }}"
                                            data-id="{{ $item->id }}"
                                            class="text-red-500 hover:text-red-700 delete-product">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $produk->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-product').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var productId = this.getAttribute('data-id');

                if (confirm('Anda yakin ingin menghapus produk dengan ID ' + productId + '?')) {
                    // Jika pengguna menekan OK, maka arahkan ke route delete
                    window.location.href = this.href;
                }
            });
        });
    </script>



</x-app-layout>
