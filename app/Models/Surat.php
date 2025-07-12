<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    /** @use HasFactory<\Database\Factories\SuratFactory> */
    use HasFactory;

    protected $fillable = [
        'no_surat',
        'perihal_surat',
        'tanggal',
        'isi',
        'ttd_1',
        'ttd_2',
        'ttd_3',
        'ttd_4',
        'ttd_5'
    ];
}
