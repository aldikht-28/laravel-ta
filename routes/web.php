<?php

use App\Http\Controllers\KasmasukController;
use App\Http\Controllers\KaskeluarController;
use App\Http\Controllers\SumberKelaurController;
use App\Http\Controllers\SumberMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LapMasjidController;
use App\Http\Controllers\LapPaudController;
use App\Http\Controllers\LapTpqController;
use App\Http\Controllers\ProfilYayasanController;
use App\Models\Dokumentasi;
use App\Models\ProfilYayasan;

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
    $profil = ProfilYayasan::select('id', 'profily', 'fotoprofil')->get();
    $dokumentasi = Dokumentasi::select('id', 'judul', 'body', 'gambar', 'tanggal')->orderBy('tanggal', 'desc')->latest()->paginate(10);
    return view('home', compact('dokumentasi', 'profil'));
});

Route::group(['middleware' => ['bendahara']], function () {

    Route::resource('sumbermasuk', SumberMasukController::class, ['only' => ['index', 'store', 'update']])->middleware('auth');
    Route::get('/sumbermasuk/{id}/konfirmasi', [SumberMasukController::class, 'konfirmasi']);
    Route::get('/sumbermasuk/{id}/delete', [SumberMasukController::class, 'delete']);

    Route::resource('sumberkeluar', SumberKelaurController::class, ['only' => ['index', 'store', 'update']])->middleware('auth');
    Route::get('/sumberkeluar/{id}/konfirmasi', [SumberKelaurController::class, 'konfirmasi']);
    Route::get('/sumberkeluar/{id}/delete', [SumberKelaurController::class, 'delete']);

    Route::resource('kasmasuk', KasmasukController::class, ['only' => ['index', 'store', 'update']])->middleware('auth');
    Route::get('/kasmasuk/{id}/konfirmasi', [KasmasukController::class, 'konfirmasi']);
    Route::get('/kasmasuk/{id}/delete', [KasmasukController::class, 'delete']);
    Route::get('/kasmasukpdf/{awal?}/{akhir?}', [KasmasukController::class, 'kasmasukpdf']);

    Route::resource('kaskeluar', KaskeluarController::class, ['only' => ['index', 'store', 'update']])->middleware('auth');
    Route::get('/kaskeluar/{id}/konfirmasi', [KaskeluarController::class, 'konfirmasi']);
    Route::get('/kaskeluar/{id}/delete', [KaskeluarController::class, 'delete']);
    Route::get('/kaskeluarpdf/{awal?}/{akhir?}', [KaskeluarController::class, 'kaskeluarpdf'])->name('kaskeluarpdf');

    Route::resource('dashboard', DashboardController::class, ['only' => 'index'])->middleware('auth');

    Route::get('/laporan', [LaporanController::class, 'index'])->middleware('auth');
    Route::post('/laporan', [LaporanController::class, 'carilaporan'])->name('carilaporan');
    Route::get('/laporanpdf/{awal?}/{akhir?}', [LaporanController::class, 'laporanpdf'])->name('laporanpdf');
});

Route::group(['middleware' => ['auth']], function () {

    Route::resource('user', UserController::class, ['only' => ['index', 'update']]);

    Route::resource('dokumentasi', DokumentasiController::class, ['only' => ['index', 'store', 'update']]);
    Route::get('/dokumentasi/{id}/konfirmasi', [DokumentasiController::class, 'konfirmasi']);
    Route::get('/dokumentasi/{id}/delete', [DokumentasiController::class, 'delete']);
});

Route::get('/laporanmasjid', [LapMasjidController::class, 'index']);
Route::post('/laporanmasjid', [LapMasjidController::class, 'carilaporanmas'])->name('carilaporanmas');
Route::get('/lapmaspdf/{awal?}/{akhir?}', [LapMasjidController::class, 'lapmaspdf'])->name('lapmaspdf');

Route::group(['middleware' => ['ketua']], function () {

    Route::get('/laporanpaud', [LapPaudController::class, 'index'])->middleware('auth');
    Route::post('/laporanpaud', [LapPaudController::class, 'carilaporanpaud'])->name('carilaporanpaud');
    Route::get('/lappaudpdf', [LapPaudController::class, 'lappaudpdf'])->name('lappaudpdf');
    Route::get('/lappaudpdf/{awal?}/{akhir?}', [LapPaudController::class, 'lappaudpdf'])->name('lappaudpdf');

    Route::get('/laporantpq', [LapTpqController::class, 'index'])->middleware('auth');
    Route::post('/laporantpq', [LapTpqController::class, 'carilaporantpq'])->name('carilaporantpq');
    Route::get('/laptpqpdf', [LapTpqController::class, 'laptpqpdf'])->name('laptpqpdf');
    Route::get('laptpqpdf/{awal?}/{akhir?}', [LapTpqController::class, 'laptpqpdf'])->name('laptpqpdf');

    Route::resource('profily', ProfilYayasanController::class, ['only' => ['index', 'store', 'update']])->middleware('auth');
});
