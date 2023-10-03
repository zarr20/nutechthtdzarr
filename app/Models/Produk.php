<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk'; // Nama tabel yang diinginkan

    protected $fillable = [
        'kategori_id',
        'nama_produk',
        'harga_beli',
        'harga_jual',
        'stok',
        'gambar',
    ];

    // Definisikan relasi dengan tabel ProdukKategori
    public function kategori()
    {
        return $this->belongsTo(ProdukKategori::class, 'kategori_id');
    }
}
