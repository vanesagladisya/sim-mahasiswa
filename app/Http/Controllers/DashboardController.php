<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = Mahasiswa::count();

        $totalLakiLaki = Mahasiswa::where(
            'jenis_kelamin',
            'Laki-laki'
        )->count();

        $totalPerempuan = Mahasiswa::where(
            'jenis_kelamin',
            'Perempuan'
        )->count();

        $totalProdi = Prodi::count();

        $mahasiswaPerProdi = Prodi::withCount('mahasiswas')
            ->get();

        $mahasiswaTerbaru = Mahasiswa::with('prodi')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalMahasiswa',
            'totalLakiLaki',
            'totalPerempuan',
            'totalProdi',
            'mahasiswaTerbaru',
            'mahasiswaPerProdi'
        ));
    }
}