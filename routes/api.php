<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Ilan\IlanlarController;
use App\Http\Controllers\Admin\Kategori\KategoriController;
use App\Http\Controllers\Admin\Kullanici\KullaniciController;
use App\Http\Controllers\Admin\Ozellik\OzelliklerController;
use App\Http\Controllers\UI\Blog\BlogController;
use App\Http\Controllers\UI\Favori\FavoriController;
use App\Http\Controllers\UI\Il\IlController;
use App\Http\Controllers\UI\Ilan\IlanController;
use App\Http\Controllers\UI\Kategori\UiKategoriController;
use Illuminate\Support\Facades\Route;

//Controllers

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('kaydol', [\App\Http\Controllers\UI\Kullanici\KullaniciController::class, 'store']);
Route::post('login', [AuthController::class, 'login']);
Route::post('admin-login', [AuthController::class, 'adminLogin']);
Route::post('validateToken', [AuthController::class, 'validateToken']);

Route::get('ui-kategoriler', [UiKategoriController::class, 'index']);
Route::get('ana-kategoriler', [UiKategoriController::class, 'anaKategoriler']);
Route::get('alt-kategoriler/{kategori}', [UiKategoriController::class, 'altKategoriler']);
Route::get('kategori-ozellikleri/{id}', [UiKategoriController::class, 'kategoriOzellikleri']);
Route::get('breadcrumb/{kategori}', [UiKategoriController::class, 'breadCrumb']);

Route::get('ilan', [IlanController::class, 'index']);
Route::get('ilan/{ilan}', [IlanController::class, 'show']);
Route::get('kategori-ilanlari/{kategori}', [IlanController::class, 'kategoriIlanlari']);

Route::get('il', [IlController::class, 'iller']);
Route::get('il/{ilce}', [IlController::class, 'ilceler']);

Route::get('sayfa', [BlogController::class, 'index']);


Route::middleware('jwt.verify:Admin')->group(function () {
    Route::apiResource('ilanlar', IlanlarController::class)->parameters(['ilanlar' => 'ilan']);
    Route::apiResource('kullanicilar', KullaniciController::class)->parameters(['kullanicilar' => 'kullanici']);
    Route::apiResource('kategoriler', KategoriController::class)->parameters(['kategoriler' => 'kategori']);
    Route::apiResource('ozellikler', OzelliklerController::class)->parameters(['ozellikler' => 'ozellik']);
    Route::apiResource('bloglar', \App\Http\Controllers\Admin\Blog\BlogController::class)->parameters(['bloglar' => 'blog']);
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::patch('ilan-onay/{ilan}', [IlanlarController::class, 'ilanOnay']);
    Route::patch('ilan-admin-yayin/{ilan}', [IlanlarController::class, 'ilanYayin']);
});


Route::middleware('jwt.verify:Kullanici')->group(function () {
    Route::apiResource('kullanici', \App\Http\Controllers\UI\Kullanici\KullaniciController::class);
    Route::patch('sifre-guncelle', [\App\Http\Controllers\UI\Kullanici\KullaniciController::class, 'sifreGuncelle']);
    Route::patch('profil-foto-guncelle', [\App\Http\Controllers\UI\Kullanici\KullaniciController::class, 'profilFotoGuncelle']);
    Route::post('ilan', [IlanController::class, 'store']);
    Route::patch('ilan/{ilan}', [IlanController::class, 'update']);
    Route::post('favori-ekle', [FavoriController::class, 'favoriEkle']);
    Route::get('kullanici-ilanlari', [\App\Http\Controllers\UI\Kullanici\KullaniciController::class, 'ilanlar']);
    Route::patch('ilan-yayin/{ilan}', [IlanController::class, 'ilanYayin']);
});
