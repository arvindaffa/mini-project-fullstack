<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function getPegawai(){
        $dataPegawai = Pegawai::all();

        return view('pegawai', compact('dataPegawai'));
    }
}
