<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameKategoriToProdukKategori extends Migration
{
    public function up()
    {
        Schema::rename('kategori', 'produk_kategori');
    }

    public function down()
    {
        Schema::rename('produk_kategori', 'kategori');
    }
}
