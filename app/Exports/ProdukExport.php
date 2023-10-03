<?php

namespace App\Exports;

// app/Exports/ProdukExport.php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Http\Request;

class ProdukExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Produk::query();

        // Tambahkan filter sesuai dengan pencarian yang dilakukan
        if ($this->request->has('search')) {
            $search = $this->request->input('search');
            $query->where('nama_produk', 'ILIKE', '%' . $search . '%');
        }

        // Tambahkan filter berdasarkan kategori yang dipilih
        if ($this->request->has('kategori')) {
            $kategoriId = $this->request->input('kategori');
            $query->where('kategori_id', $kategoriId);
        }

        return $query->get();
    }
    public function headings(): array
    {
        return [
            'ID',
            'Nama Produk',
            'Harga Beli',
            'Harga Jual',
            'Stok',
        ];
    }
}
