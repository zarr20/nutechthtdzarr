<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (isset($produk))
                {{ __('Edit Produk') }}
            @else
                {{ __('Tambah Produk') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden ">
                <div class="bg-white ">




                    <form
                        @if (isset($produk)) action="{{ route('produk.update', ['id' => $produk->id]) }}"
                        @else
                            action="{{ route('produk.store') }}" @endif
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        @if (isset($produk))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-3 gap-4">
                            <!-- Kategori Input -->
                            <div>
                                <div class="mb-4">
                                    <label for="kategori" class="block font-bold text-xs text-gray-700">Kategori</label>
                                    <select name="kategori" id="kategori"
                                        class="form-input mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}"
                                                {{ isset($produk) && $produk->kategori_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Nama Produk Input -->
                            <div class="col-span-2">
                                <div class="mb-4">
                                    <label for="nama_produk" class="block font-bold text-xs text-gray-700">Nama
                                        Produk</label>
                                    <input type="text" name="nama_produk" id="nama_produk"
                                        class="form-input mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                        value="{{ isset($produk) ? $produk->nama_produk : '' }}">
                                </div>
                            </div>

                            <!-- Harga Beli Input -->
                            <div class="mb-4">
                                <label for="harga_beli" class="block font-bold text-xs text-gray-700">Harga Beli</label>
                                <input type="text" name="harga_beli" id="harga_beli"
                                    class="form-input mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    value="{{ isset($produk) ? $produk->harga_beli : '' }}">
                            </div>

                            <!-- Harga Jual Input -->
                            <div class="mb-4">
                                <label for="harga_jual" class="block font-bold text-xs text-gray-700">Harga Jual</label>
                                <input type="text" name="harga_jual" id="harga_jual"
                                    class="form-input mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    value="{{ isset($produk) ? $produk->harga_jual : '' }}">
                            </div>

                            <!-- Stok Input -->
                            <div class="mb-4">
                                <label for="stok" class="block font-bold text-xs text-gray-700">Stok</label>
                                <input type="text" name="stok" id="stok"
                                    class="form-input mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    value="{{ isset($produk) ? $produk->stok : '' }}">
                            </div>

                            <!-- Gambar Input -->
                            <div class="col-span-3">
                                <div class="mb-4">
                                    <label for="gambar" class="block font-bold text-xs text-gray-700">Gambar</label>
                                    <input type="file" name="gambar" id="gambar"
                                        class="form-input mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="mt-5">
                            <x-button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                @if (isset($produk))
                                    Update Product
                                @else
                                    Create Product
                                @endif
                            </x-button>
                        </div>
                    </form>

                    <!-- Tambahkan pesan kesalahan validasi di sini -->
                    @if ($errors->any())
                        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <span class="absolute top-0 right-0 bottom-0 px-4 py-3" id="closeNotification">
                                <svg class="fill-current h-6 w-6 text-red-500" role="button"
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-x" viewBox="0 0 16 16">
                                    <path
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </span>
                        </div>

                        <script>
                            document.getElementById('closeNotification').addEventListener('click', function() {
                                var notification = this.parentElement;
                                notification.style.display = 'none';
                            });
                        </script>
                    @endif


                </div>
            </div>
        </div>
    </div>


    <script>
        // Ambil referensi ke input field harga beli dan harga jual
        var inputHargaBeli = document.getElementById('harga_beli');
        var inputHargaJual = document.getElementById('harga_jual');

        // Tambahkan event listener untuk input field harga beli
        inputHargaBeli.addEventListener('input', function() {
            // Ambil nilai dari input harga beli
            var hargaBeli = parseFloat(this.value);

            // Periksa apakah nilai harga beli valid
            if (!isNaN(hargaBeli) && hargaBeli > 0) {
                // Hitung harga jual (harga beli + 30%)
                var hargaJual = hargaBeli + (0.3 * hargaBeli);

                // Set nilai input harga jual
                inputHargaJual.value = hargaJual.toFixed(2); // Menampilkan dua angka desimal
            } else {
                // Jika harga beli tidak valid, kosongkan input harga jual
                inputHargaJual.value = '';
            }
        });
    </script>
</x-app-layout>
