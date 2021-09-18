<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::middleware('auth')->group(function() {
    Route::resource('karyawan', KaryawanController::class);
    // Nasabah
    Route::resource('nasabah', NasabahController::class);
    Route::get('jumlah-pinjaman', 'NasabahController@jumlahPinjaman')->name('jPJM');
    Route::get('bunga-pinjaman', 'NasabahController@bungaPinjaman')->name('bPJM');
    Route::get('jumlah-Tabungan', 'NasabahController@jumlahTabungan')->name('jTAB');
    // Tabungan
    Route::resource('tabungan', TabunganController::class);
    Route::get('tabungan/create/{tabungan}', 'TabunganController@create')->name('create.tabungan');
    Route::post('tabungan/{tabungan}', 'TabunganController@store')->name('store.tabungan');
    // Transaksi
    Route::resource('transaksi', TransaksiController::class);
    Route::get('transaksi-nasabah', 'TransaksiController@dashboard')->name('transaksi.dashboard');
    Route::get('transaksi/{transaksi}', 'TransaksiController@index')->name('transaksi');
    Route::get('transaksi/create/{transaksi}', 'TransaksiController@create')->name('create.transaksi');
    Route::post('transaksi/{transaksi}', 'TransaksiController@store')->name('store.transaksi');
    Route::get('transaksi/tabungan/{tabungan}', 'TransaksiController@transaksiTabungan')->name('transaksi-tabungan');
    // Laba
    Route::resource('laba', LabaController::class);
     // Piutang
     Route::resource('piutang', PiutangController::class);
    //  Export
    Route::resource('Export', ExportController::class);
    Route::get('tabungan', 'ExportController@tabungan')->name('export.tabungan');
    Route::get('transaksi-print', 'ExportController@trsprint')->name('export.transaksi');
    Route::get('transaksi-print/notransaksi', 'ExportController@notrsprint')->name('export.notransaksi');
  });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
