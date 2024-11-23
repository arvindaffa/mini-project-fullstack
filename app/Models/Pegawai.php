<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'data_pegawai';

    protected $fillable = [
        'nama',
        'email',
        'departemen',
        'umur',
        'jenis_kelamin',
        'tanggal_masuk',
        'foto',
        'cv',
    ];
}
