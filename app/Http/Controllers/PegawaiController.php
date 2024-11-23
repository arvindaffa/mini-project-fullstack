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

    public function addPegawai(){
        return view('tambahPegawai');
    }

    public function uploadCv(Request $request){
        $request->validate([
            'file' => 'required|mimes:pdf|max:5120',
        ]);

        $cvPath = $request->file('file')->store('uploads/cv', 'public');

        session()->put('cvPath', $cvPath);

        return response()->json(['cvPath' => $cvPath]);
    }

    public function submitPegawai(Request $request){
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'umur' => 'required|integer',
            'departemen' => 'required|string',
            'jenis_kelamin' => 'required|string|in:Pria,Wanita',
            'tanggal_masuk' => 'required|date',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads/foto', 'public');
        }

        $cvPath = session()->get('cvPath', null);

        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $nama = $firstName . " " .  $lastName;
        $email = $firstName . "." .  $lastName . "@biis.corp";

        Pegawai::create([
            'nama' => $nama,
            'email' => $email,
            'umur' => $request->input('umur'),
            'departemen' => $request->input('departemen'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tanggal_masuk' => $request->input('tanggal_masuk'),
            'foto' => $fotoPath,
            'cv' => $cvPath,
        ]);

        session()->forget('cvPath');

        return redirect()->route('pegawai')->with('success', 'Pegawai berhasil ditambahkan!');
    }

    public function getPegawaiApi()
    {
        $dataPegawai = Pegawai::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Pegawai',
            'data' => $dataPegawai,
        ], 200);
    }
}
