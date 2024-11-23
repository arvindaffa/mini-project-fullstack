<?php

use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;

Route::controller(PegawaiController::class)->group(function () {
    Route::get('/', 'getPegawai')-> name('pegawai'); //get data pegawai lewat db
    Route::get('/tambahpegawai', 'addPegawai'); //nampilin view add pegawai
    Route::post('/cek-email', 'cekEmail'); //validasi email
    Route::post('/upload-cv', 'uploadCv')->name('uploadCv'); //upload cv
    Route::post('/tambahpegawai/add', 'submitPegawai'); //store request
    Route::get('/api/pegawai', 'getPegawaiApi')-> name('api.pegawai'); //get data pegawai lewat api
    Route::get('/detailpegawai/{id}', 'detailPegawai')->name('detailpegawai'); //nampilin data detail pegawai
    Route::get('/editpegawai/{id}', 'editPegawai')->name('editpegawai'); //nampilin view edit pegawai
    Route::put('/updatepegawai/{id}', 'update')->name('updatepegawai'); //update request
    Route::delete('/pegawai/{id}', 'hapusPegawai')->name('deletepegawai');
});



