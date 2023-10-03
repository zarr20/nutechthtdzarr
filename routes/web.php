<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route::get('/profil', function () {
    //     return view('user.profil'); 
    // })->name('profil');

    Route::get('/profil', [UserController::class, 'index'])->name('profil');

    Route::put('/user', [UserController::class, 'update'])->name('user.update');

    // Route::get('/produk', function () {
    //     return view('user.produk'); 
    // })->name('produk');

    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
    Route::get('/produk/add', [ProdukController::class, 'add'])->name('produk.add');
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');

    // Route untuk halaman edit produk
    Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');

    // Route untuk menghapus produk
    Route::get('/produk/delete/{id}', [ProdukController::class, 'delete'])->name('produk.delete');
    Route::get('/produk/export', [ProdukController::class, 'export'])->name('produk.export');

});



require __DIR__ . '/auth.php';
