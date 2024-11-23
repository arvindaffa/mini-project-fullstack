<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class PegawaiController extends Controller
{
    public function getPegawai(){
        return view('pegawai');
    }

    public function addPegawai(){
        return view('tambahPegawai');
    }

    public function cekEmail(Request $request) {
        $email = $request->input('email');
        $exists = Pegawai::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
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
            'lastName' => 'nullable|string|max:255',
            'emailName' => 'required|string|max:255',
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

        $firstName = ucwords(strtolower(trim($validated['firstName'])));
        $lastName = isset($validated['lastName']) ? ucwords(strtolower(trim($validated['lastName']))) : null;
        if (empty($lastName)) {
            $nama = $firstName;
        } else {
            $nama = $firstName . " " . $lastName;
        }
        $emailName = strtolower(trim($validated['emailName']));
        $emailNameNew = str_replace(' ', '', $emailName);
        $email = $emailNameNew . "@biis.corp";

        Pegawai::create([
            'nama' => $nama,
            'email' => $email,
            'umur' => $validated['umur'],
            'departemen' => $validated['departemen'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tanggal_masuk' => $validated['tanggal_masuk'],
            'foto' => $fotoPath,
            'cv' => $cvPath,
        ]);

        session()->forget('cvPath');

        return redirect()->route('pegawai');
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

    public function detailPegawai($id){
        $pegawai = Pegawai::find($id);
        if (!$pegawai) {
            return redirect()->route('pegawai');
        }

        return view('detailPegawai', compact('pegawai'));
    }

    public function editPegawai($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $emailName = explode('@', $pegawai->email);
        $emailNameNew = $emailName[0];

        return view('editPegawai', compact('pegawai', 'emailNameNew'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'emailName' => 'required|string|max:255',
            'umur' => 'required|integer|min:0',
            'departemen' => 'required|string',
            'jenis_kelamin' => 'required|string|in:Pria,Wanita',
            'tanggal_masuk' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cv' => 'nullable|mimes:pdf|max:5120',
        ]);

        // Cari data pegawai berdasarkan ID
        $pegawai = Pegawai::findOrFail($id);

        $nama = ucwords(strtolower(trim($validated['nama'])));
        $emailName = strtolower(trim($validated['emailName']));
        $emailName = str_replace(' ', '', $emailName);
        $email = $emailName . "@biis.corp";

        // Update foto jika ada file baru yang diunggah
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pegawai->foto) {
                Storage::disk('public')->delete($pegawai->foto);
            }

            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('uploads/foto', 'public');
        } else {
            $fotoPath = $pegawai->foto; // Tetap gunakan foto lama
        }

        // Update CV jika ada file baru yang diunggah
        if ($request->hasFile('cv')) {
            // Hapus CV lama jika ada
            if ($pegawai->cv) {
                Storage::disk('public')->delete($pegawai->cv);
            }

            // Simpan CV baru
            $cvPath = $request->file('cv')->store('uploads/cv', 'public');
        } else {
            $cvPath = $pegawai->cv; // Tetap gunakan CV lama
        }

        $pegawai->update([
            'nama' => $nama,
            'email' => $email,
            'umur' => $validated['umur'],
            'departemen' => $validated['departemen'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tanggal_masuk' => $validated['tanggal_masuk'],
            'foto' => $fotoPath,
            'cv' => $cvPath,
        ]);

        return redirect()->route('detailpegawai', $pegawai->id);
    }

    public function hapusPegawai($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        // Hapus file foto jika ada
        if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
            Storage::disk('public')->delete($pegawai->foto);
        }

        // Hapus file CV jika ada
        if ($pegawai->cv && Storage::disk('public')->exists($pegawai->cv)) {
            Storage::disk('public')->delete($pegawai->cv);
        }


        $pegawai->delete();

        return redirect()->route('pegawai');
    }
}
