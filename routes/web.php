<?php

use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(PegawaiController::class)->group(function () {
    Route::get('/pegawai', 'getPegawai')-> name('pegawai');
    Route::get('/tambahpegawai', 'addPegawai');
    Route::post('/upload-cv', 'uploadCv')->name('uploadCv');
    Route::post('/tambahpegawai/add', 'submitPegawai');
});
