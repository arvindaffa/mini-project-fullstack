@extends('template')

@section('title', 'Detail Pegawai')

@section('judulForm', 'Detail Pegawai')

@section('card')

    <div class="d-flex justify-content-end">
        <form action="{{ route('deletepegawai', $pegawai->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus Data</button>
        </form>
    </div>

    {{-- Foto --}}
    @if ($pegawai->foto)
        <div class="d-flex justify-content-center">
            <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto Pegawai" class="img-fluid"
                style="max-width: 200px; max-height: 200px;">
        </div>
    @endif

    {{-- Nama --}}
    <div class="mb-3 row mt-3">
        <label for="firstName" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" id="firstName" name="firstName" class="form-control" value="{{ $pegawai->nama }}"
                disabled>
        </div>
    </div>

    {{-- Email --}}
    <div class="mb-3 row">
        <label for="firstName" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" id="firstName" name="firstName" class="form-control" value="{{ $pegawai->email }}"
                disabled>
        </div>
    </div>

    {{-- Departemen --}}
    <div class="mb-3 row">
        <label for="firstName" class="col-sm-2 col-form-label">Departemen</label>
        <div class="col-sm-10">
            <input type="text" id="firstName" name="firstName" class="form-control" value="{{ $pegawai->departemen }}"
                disabled>
        </div>
    </div>

    {{-- Umur --}}
    <div class="mb-3 row">
        <label for="firstName" class="col-sm-2 col-form-label">Umur</label>
        <div class="col-sm-10">
            <input type="text" id="firstName" name="firstName" class="form-control" value="{{ $pegawai->umur }} Tahun"
                disabled>
        </div>
    </div>

    {{-- Jenis Kelamin --}}
    <div class="mb-3 row">
        <label for="firstName" class="col-sm-2 col-form-label">Jenis Kelamin</label>
        <div class="col-sm-10">
            <input type="text" id="firstName" name="firstName" class="form-control" value="{{ $pegawai->jenis_kelamin }}"
                disabled>
        </div>
    </div>

    {{-- Tanggal Masuk --}}
    <div class="mb-3 row">
        <label for="firstName" class="col-sm-2 col-form-label">Tanggal Masuk</label>
        <div class="col-sm-10">
            <input type="text" id="firstName" name="firstName" class="form-control" value="{{ $pegawai->tanggal_masuk }}"
                disabled>
        </div>
    </div>

    {{-- CV --}}
    <div class="mb-3 row">
        <label for="CV" class="col-sm-2">CV</label>
        <div class="col-sm-10">
            @if ($pegawai->cv)
                <a href="{{ asset('storage/' . $pegawai->cv) }}" target="_blank" class="btn btn-primary">
                    Lihat CV
                </a>
            @else
                <p>Tidak ada CV yang diunggah</p>
            @endif
        </div>
    </div>

    {{-- Tombol --}}
    <div class="d-flex justify-content-between">
        <a href="/" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('editpegawai', $pegawai->id) }}" class="btn btn-warning">Edit Data</a>
    </div>
@endsection
