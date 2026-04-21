<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    protected $fillable = [
    'siswa_id',
    'kategori_id',
    'lokasi',
    'keterangan',
    'status',
    'feedback',
    'tanggal_aspirasi',
    'foto'
    ];

    public function siswa()
    {
        return $this->belongsTo(\App\Models\Siswa::class);
    }

    public function kategori()
    {
         return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    
}
