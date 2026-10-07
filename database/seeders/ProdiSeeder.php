<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        Prodi::create([
            'kode_prodi' => 'TI',
            'nama_prodi' => 'Teknik Informatika',
            'fakultas' => 'Teknologi Informasi',
        ]);

        Prodi::create([
            'kode_prodi' => 'SI',
            'nama_prodi' => 'Sistem Informasi',
            'fakultas' => 'Teknologi Informasi',
        ]);

        Prodi::create([
            'kode_prodi' => 'TE',
            'nama_prodi' => 'Teknik Elektro',
            'fakultas' => 'Teknik',
        ]);
    }
}