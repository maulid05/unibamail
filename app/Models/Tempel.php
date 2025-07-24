<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tempel extends Model
{
    /** @use HasFactory<\Database\Factories\TempelFactory> */
    use HasFactory;

    protected $fillable = [
        'file',
        'id_surat'
    ];
    
    protected $with = ['surat'];

    public function surat() 
    {
        return $this->belongsTo(Surat::class, 'surat');
    }
}
