<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    /** @use HasFactory<\Database\Factories\SuratFactory> */
    use HasFactory;

    protected $fillable = [
        'no_urut',
        'kode_instansi',
        'jenis_surat',
        'bulan',
        'tahun',
        'perihal',
        'tanggal',
        'isi',
        'user_id',
    ];

    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
