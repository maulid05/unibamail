<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    /** @use HasFactory<\Database\Factories\QrCodeFactory> */
    use HasFactory;

    protected $fillable = [
        'qrcode',
        'id_relasi',
        'id_user',
    ];
}
