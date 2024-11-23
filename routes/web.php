<?php

use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('pegawai', function () {
    return view('pegawai');
});

Route::controller(PegawaiController::class)->group(function () {
    Route::get('/pegawai2', 'getPegawai');
    Route::get('/tambahpegawai', 'addPegawai');
    // Route::post('/daftar/add','add');
    // Route::get('/homepagepelanggan', 'index');
});
