<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\SosialController;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\SendingController;
use App\Http\Controllers\MusikController;
use App\Http\Controllers\RemajaController;
use App\Http\Controllers\JadwalIbadahController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\NaposoController;
use App\Http\Controllers\ParompuanController;
use App\Http\Controllers\PunguanController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\LanjutController;
use App\Http\Controllers\TingController;
use App\Http\Controllers\AutentikasiController;



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

Route::get('/dash_bph', function () {
    return view('dashboard');
});


//BERITA
Route::resource('beritas', BeritaController::class);

//DIAKONIA SOSIAL
Route::resource('sosial', SosialController::class);

//DIAKONIA KESEHATAN
Route::resource('kesehatan', KesehatanController::class);

//DIAKONIA MASYARAKAT
Route::resource('masyarakat', MasyarakatController::class);

//DIAKONIA PENDIDIKAN
Route::resource('pendidikan', PendidikanController::class);


//KOINONIA SENDING
Route::resource('sending', SendingController::class);

//KOINONIA MUSIK
Route::resource('musik', MusikController::class);



//MARTURIA REMAJA
Route::resource('remaja', RemajaController::class);

//MARTURIA SEKOLAH MINGGU
Route::resource('sekolah', SekolahController::class);

//MARTURIA NAPOSO
Route::resource('naposo', NaposoController::class);

//MARTURIA PAROMPUAN
Route::resource('parompuan', ParompuanController::class);

//MARTURIA PUNGUAN AMA
Route::resource('punguan', PunguanController::class);

//MARTURIA LANSIA
Route::resource('lanjut', LanjutController::class);



//TENTANG JADWAL IBADAH
Route::get('/jadwalibadah', [JadwalIbadahController::class, 'lihatData']);
Route::post('/tentang/tambahJadwal', [JadwalIbadahController::class, 'tambah']);
Route::get('/tentang/tambahJadwal', [JadwalIbadahController::class, 'create']);
Route::get('/tentang/editJadwal/{id}', [JadwalIbadahController::class, 'edit']);
Route::get('/tentang/editJadwal', [JadwalIbadahController::class, 'update']);
Route::post('/tentang/editJadwal', [JadwalIbadahController::class, 'ubah']);
Route::get('/tentang/hapus/{id}', [JadwalIbadahController::class, 'hapus']);

//TENTANG TINGTING
Route::resource('ting', TingController::class);


Route::get('/aula/user', [BookingAulaController::class, 'index2']);



Route::get('/login', [AutentikasiController::class, 'login']);
Route::post('/login', [AutentikasiController::class, 'authenticate']);

Route::get('/daftar', [AutentikasiController::class, 'daftar']);
Route::post('/daftar', [AutentikasiController::class, 'store']);
Route::post('/logout', [AutentikasiController::class, 'logout']);


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['level_check:1']], function () {
        Route::get('/dash_pendeta', [AutentikasiController::class, 'dash_p']);
    });
    Route::group(['middleware' => ['level_check:2']], function () {
        Route::get('/dash_bph', [AutentikasiController::class, 'dash_b']);
    });
    Route::group(['middleware' => ['level_check:3']], function () {
        Route::get('/dash_user', [AutentikasiController::class, 'dash_u']);
    });
});
