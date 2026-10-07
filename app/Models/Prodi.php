<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Mahasiswa;

class Prodi extends Model
{
    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
        'fakultas',
    ];

    public function mahasiswas(): HasMany
    {
        return $this->hasMany(Mahasiswa::class);
    }
}