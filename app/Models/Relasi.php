<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relasi extends Model
{
    /** @use HasFactory<\Database\Factories\RelasiFactory> */
    use HasFactory;

    protected $fillable = [
        'id_pengirim',
        'id_penerima',
        'id_surat',
        'posisi'
    ];  
}
