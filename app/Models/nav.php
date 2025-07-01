<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nav extends Model
{
    /** @use HasFactory<\Database\Factories\NavFactory> */
    use HasFactory;
    protected $fillable = [
        'Dashboard',
        'Buat pesan',
        'Tambah tujuan',
        'Riwayat'
    ];
}
