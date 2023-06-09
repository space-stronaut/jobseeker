<?php

use App\Http\Controllers\carreer\JobOfferController as CarreerJobOfferController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PelamaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('job', JobOfferController::class);
Route::resource('pelamaran', PelamaranController::class);
Route::resource('ujian', UjianController::class);
Route::put('/ujian/nilai/{id}', [UjianController::class, 'nilai'])->name('ujian.nilai');
Route::resource('interview', InterviewController::class);
Route::put('/interview/nilai/{id}', [InterviewController::class, 'nilai'])->name('interview.nilai');
Route::resource('notification', NotificationController::class);
Route::get('/pelamaran/download/{id}', [PelamaranController::class, 'download'])->name('pelamaran.download');
Route::get('/ujian/soal/{id}', [UjianController::class, 'downloadSoal'])->name('downloadSoal.download');
Route::get('/ujian/jawaban/{id}', [UjianController::class, 'downloadJawaban'])->name('downloadJawaban.download');
Route::resource('user', UserController::class);
Route::put('/ujian/batas/{id}', [UjianController::class, 'batas'])->name('ujian.batas');
Route::resource('kandidatoffer', CarreerJobOfferController::class);
Route::resource('profile', ProfileController::class);
Route::post('/pdf/rekapan', [PelamaranController::class, 'cetak'])->name('pelamar.cetak');