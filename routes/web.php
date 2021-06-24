<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Manajemen\ArtikelController;
use App\Http\Controllers\Manajemen\JurusanController;
use App\Http\Controllers\Manajemen\GaleriFotoController;
use App\Http\Controllers\Manajemen\GaleriVideoController;
use App\Http\Controllers\Manajemen\KomentarBalasanController;
use App\Http\Controllers\Manajemen\FileController;

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
Route::middleware(['visitors'])->get('/', function () {
    // return view('welcome');
    return view('template.education.pages.index');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

    Route::group(['prefix'=>'manajemen'],function(){
        Route::get('/pengguna', 'App\Http\Controllers\PenggunaController@index')->name('pengguna');
        Route::post('pengguna/simpan','App\Http\Controllers\PenggunaController@simpan')->name('pengguna.simpan');
        Route::post('pengguna/ubah','App\Http\Controllers\PenggunaController@ubah')->name('pengguna.ubah');
        Route::get('pengguna/data/{id}','App\Http\Controllers\PenggunaController@data')->name('pengguna.data');
        Route::delete('pengguna/hapus/{id}','App\Http\Controllers\PenggunaController@hapus')->name('pengguna.hapus');

        Route::resource('pegawai',PegawaiController::class);
        Route::post('pegawai-edit-status',[PegawaiController::class,'edit_status'])->name('pegawai.edit-status');

        Route::get('/kategori', 'App\Http\Controllers\Manajemen\KategoriController@index')->name('manajemen.kategori');
        Route::post('kategori/simpan','App\Http\Controllers\Manajemen\KategoriController@simpan')->name('manajemen.kategori.simpan');
        Route::post('kategori/ubah','App\Http\Controllers\Manajemen\KategoriController@ubah')->name('manajemen.kategori.ubah');
        Route::get('kategori/data/{id}','App\Http\Controllers\Manajemen\KategoriController@data')->name('manajemen.kategori.data');
        Route::delete('kategori/hapus/{id}','App\Http\Controllers\Manajemen\KategoriController@hapus')->name('manajemen.kategori.hapus');

        Route::resource('jurusan',JurusanController::class);
        Route::get('jurusan-datatable',[JurusanController::class,'datatable'])->name('jurusan.datatable');
        Route::post('jurusan-edit-status',[JurusanController::class,'edit_status'])->name('jurusan.edit-status');

        Route::get('/event', 'App\Http\Controllers\Manajemen\EventController@index')->name('manajemen.event');
        Route::post('event/simpan','App\Http\Controllers\Manajemen\EventController@simpan')->name('manajemen.event.simpan');
        Route::post('event/ubah','App\Http\Controllers\Manajemen\EventController@ubah')->name('manajemen.event.ubah');
        Route::get('event/data/{id}','App\Http\Controllers\Manajemen\EventController@data')->name('manajemen.event.data');
        Route::delete('event/hapus/{id}','App\Http\Controllers\Manajemen\EventController@hapus')->name('manajemen.event.hapus');

        Route::get('/lokasi', 'App\Http\Controllers\Manajemen\LokasiController@index')->name('manajemen.lokasi');
        Route::post('lokasi/simpan','App\Http\Controllers\Manajemen\LokasiController@simpan')->name('manajemen.lokasi.simpan');
        Route::post('lokasi/ubah','App\Http\Controllers\Manajemen\LokasiController@ubah')->name('manajemen.lokasi.ubah');
        Route::delete('lokasi/hapus/{id}','App\Http\Controllers\Manajemen\LokasiController@hapus')->name('manajemen.lokasi.hapus');


        Route::resource('artikel',ArtikelController::class);
        Route::get('artikel-datatable',[ArtikelController::class,'datatable'])->name('artikel.datatable');
        Route::post('artikel-edit-status',[ArtikelController::class,'edit_status'])->name('artikel.edit-status');
        
        Route::resource('komentar',KomentarBalasanController::class);
        Route::get('komentar-datatable',[KomentarBalasanController::class,'datatable'])->name('komentar.datatable');
        Route::post('komentar-edit-status',[KomentarBalasanController::class,'edit_status'])->name('komentar.edit-status');

        Route::resource('galeri-foto',GaleriFotoController::class);
        Route::get('galeri-foto-datatable',[GaleriFotoController::class,'datatable'])->name('galeri-foto.datatable');
        Route::post('galeri-foto-edit-status',[GaleriFotoController::class,'edit_status'])->name('galeri-foto.edit-status');
        
        Route::resource('galeri-video',GaleriVideoController::class);
        Route::get('galeri-video-datatable',[GaleriVideoController::class,'datatable'])->name('galeri-video.datatable');
        Route::post('galeri-video-edit-status',[GaleriVideoController::class,'edit_status'])->name('galeri-video.edit-status');

        Route::get('/file', 'App\Http\Controllers\Manajemen\FileController@index')->name('file');
        Route::post('file/simpan','App\Http\Controllers\Manajemen\FileController@simpan')->name('file.simpan');
        Route::post('file/ubah','App\Http\Controllers\Manajemen\FileController@ubah')->name('file.ubah');
        Route::get('file/data/{id}','App\Http\Controllers\Manajemen\FileController@data')->name('file.data');
        Route::delete('file/hapus/{id}','App\Http\Controllers\Manajemen\FileController@hapus')->name('file.hapus');
        Route::post('file-edit-status',[FileController::class,'edit_status'])->name('file.edit-status');

    });

    Route::group(['prefix'=>'pengaturan'],function(){
        Route::get('/menu', 'App\Http\Controllers\Pengaturan\MenuController@index')->name('pengaturan.menu');
        Route::post('menu/simpan','App\Http\Controllers\Pengaturan\MenuController@simpan')->name('pengaturan.menu.simpan');
        Route::post('menu/ubah','App\Http\Controllers\Pengaturan\MenuController@ubah')->name('pengaturan.menu.ubah');
        Route::get('menu/data/{id}','App\Http\Controllers\Pengaturan\MenuController@data')->name('pengaturan.menu.data');
        Route::post('menu/hapus','App\Http\Controllers\Pengaturan\MenuController@hapus')->name('pengaturan.menu.hapus');

        Route::get('/banner', 'App\Http\Controllers\Pengaturan\BannerController@index')->name('pengaturan.banner');
        Route::post('banner/simpan','App\Http\Controllers\Pengaturan\BannerController@simpan')->name('pengaturan.banner.simpan');
        Route::post('banner/ubah','App\Http\Controllers\Pengaturan\BannerController@ubah')->name('pengaturan.banner.ubah');
        Route::get('banner/data/{id}','App\Http\Controllers\Pengaturan\BannerController@data')->name('pengaturan.banner.data');
        Route::delete('banner/hapus/{id}','App\Http\Controllers\Pengaturan\BannerController@hapus')->name('pengaturan.banner.hapus');

        Route::get('/logo', 'App\Http\Controllers\Pengaturan\LogoController@index')->name('pengaturan.logo');
        Route::post('logo/simpan','App\Http\Controllers\Pengaturan\LogoController@simpan')->name('pengaturan.logo.simpan');
        Route::post('logo/ubah','App\Http\Controllers\Pengaturan\LogoController@ubah')->name('pengaturan.logo.ubah');

        Route::get('/lokasi', 'App\Http\Controllers\Manajemen\LokasiController@index')->name('pengaturan.lokasi');
        Route::post('lokasi/simpan','App\Http\Controllers\Manajemen\LokasiController@simpan')->name('pengaturan.lokasi.simpan');
        Route::post('lokasi/ubah','App\Http\Controllers\Manajemen\LokasiController@ubah')->name('pengaturan.lokasi.ubah');
        Route::delete('lokasi/hapus/{id}','App\Http\Controllers\Manajemen\LokasiController@hapus')->name('pengaturan.lokasi.hapus');


    });

});

Route::get('{page}/{param?}',[FrontendController::class,'pages']);
Route::post('simpan-pesan',[FrontendController::class,'simpan_pesan']);

Route::get('captcha',[FrontendController::class,'imageCode']);
Route::post('check-captcha-code',[FrontendController::class,'check_captcha_code']);
Route::get('refereshcapcha',[FrontendController::class,'refereshCapcha']);

Route::get('show-file/{dir}/{filename}', 'App\Http\Controllers\Controller@displayFiles');
Route::get('show-files/{dir}/{filename}', 'App\Http\Controllers\Controller@displayFile');
Route::get('show-image/{dir}/{filename}', 'App\Http\Controllers\Controller@showImage');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');