<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukKategori extends Model
{
    use HasFactory;

    protected $table = 'produk_kategori'; // Nama tabel 'produk_kategori' dalam database

    // Definisikan relasi dengan tabel Produk
    public function produk()
    {
        return $this->hasMany(Product::class, 'kategori_id');
    }
}