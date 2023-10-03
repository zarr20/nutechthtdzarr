<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProdukKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use App\Exports\ProdukExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;


class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategoriFilter = $request->input('kategori');

        $produkQuery = Produk::query();

        // Filter berdasarkan pencarian
        if ($search) {
            $produkQuery->where('nama_produk', 'ILIKE', '%' . $search . '%');
        }

        // Filter berdasarkan kategori
        if ($kategoriFilter) {
            $produkQuery->where('kategori_id', $kategoriFilter);
        }

        $kategori = ProdukKategori::all();
        $produk = $produkQuery->paginate(10);

        // Menambahkan parameter query ke objek Paginator
        $produk->appends([
            'search' => $search,
            'kategori' => $kategoriFilter,
        ]);


        return view('user.produk', compact('produk', 'kategori'));
    }

    public function add()
    {
        $kategori = ProdukKategori::all();

        return view('user.produk_input', compact('kategori'));
    }


    public function store(Request $request)
    {

        $produk = new Produk();

        // Validasi input form sesuai dengan aturan yang Anda tentukan
        $request->validate([
            'kategori' => 'required',
            'nama_produk' => 'required|string|max:255|unique:produk,nama_produk,' . ($produk->id ?? 'NULL'),
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:100',
        ]);


        $produk->kategori_id = $request->input('kategori');
        $produk->nama_produk = $request->input('nama_produk');
        $produk->harga_beli = $request->input('harga_beli');
        $produk->harga_jual = $request->input('harga_jual');
        $produk->stok = $request->input('stok');

        // Mengunggah gambar dan menyimpannya di storage
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk_images', 'public');
            $produk->gambar = $gambarPath;
        }

        $produk->save();

        // Redirect kembali ke halaman produk dengan pesan sukses
        return redirect()->route('produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = ProdukKategori::all(); // Ambil semua data kategori

        return view('user.produk_input', compact('produk', 'kategori'));
    }
    public function update(Request $request, $id)
    {
        // Validasi input form
        $request->validate([
            'kategori' => 'required|integer',
            'nama_produk' => 'required|string|max:255',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:100',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->kategori_id = $request->kategori;
        $produk->nama_produk = $request->nama_produk;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->stok = $request->stok;

        // Jika ada file gambar diunggah, simpan gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if (Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $imagePath = $request->file('gambar')->store('produk_images', 'public');
            $produk->gambar = $imagePath;
        }

        $produk->save();

        return redirect()->route('produk')->with('success', 'Produk berhasil diperbarui.');
    }

    public function delete($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus gambar terkait dari penyimpanan (storage)
        if (Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        // Hapus produk dari database
        $produk->delete();

        return redirect()->route('produk')->with('success', 'Produk berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $date = Carbon::now()->format('dmY');
        $fileName = 'produk_' . $date . '.xlsx';

        return Excel::download(new ProdukExport($request), $fileName);
    }
}
