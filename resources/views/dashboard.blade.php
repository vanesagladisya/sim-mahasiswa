@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold mb-1">
            Dashboard
        </h2>

        <p class="text-muted mb-0">
            Selamat datang kembali,
            {{ auth()->user()->name }}
        </p>

    </div>

    <div>

        <a
            href="{{ route('mahasiswa.create') }}"
            class="btn btn-primary"
        >
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Mahasiswa
        </a>

    </div>

</div>


{{-- ========================================= --}}
{{-- STATISTIK --}}
{{-- ========================================= --}}

<div class="row g-4 mb-4">

    {{-- Total Mahasiswa --}}
    <div class="col-md-3">

        <div class="card stat-card shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">
                            Total Mahasiswa
                        </small>

                        <h2 class="fw-bold">
                            {{ $totalMahasiswa }}
                        </h2>

                    </div>

                    <i class="bi bi-people fs-1 text-primary"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- Laki-laki --}}
    <div class="col-md-3">

        <div class="card stat-card shadow-sm">

            <div class="card-body">

                <small class="text-muted">
                    Laki-laki
                </small>

                <h2 class="fw-bold text-primary">
                    {{ $totalLakiLaki }}
                </h2>

            </div>

        </div>

    </div>


    {{-- Perempuan --}}
    <div class="col-md-3">

        <div class="card stat-card shadow-sm">

            <div class="card-body">

                <small class="text-muted">
                    Perempuan
                </small>

                <h2 class="fw-bold text-danger">
                    {{ $totalPerempuan }}
                </h2>

            </div>

        </div>

    </div>


    {{-- Program Studi --}}
    <div class="col-md-3">

        <div class="card stat-card shadow-sm">

            <div class="card-body">

                <small class="text-muted">
                    Program Studi
                </small>

                <h2 class="fw-bold text-success">
                    {{ $totalProdi }}
                </h2>

            </div>

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- MAHASISWA PER PROGRAM STUDI --}}
{{-- ========================================= --}}

<div class="row g-4 mb-4">

    {{-- GRAFIK --}}
    <div class="col-md-8">

        <div class="card shadow-sm">

            <div class="card-header bg-white">

                <h5 class="mb-0 fw-bold">
                    Mahasiswa per Program Studi
                </h5>

            </div>

            <div class="card-body">

                <canvas id="mahasiswaProdiChart"></canvas>

            </div>

        </div>

    </div>


    {{-- DATA PROGRAM STUDI --}}
    <div class="col-md-4">

        <div class="card shadow-sm">

            <div class="card-header bg-white">

                <h5 class="mb-0 fw-bold">
                    Data Program Studi
                </h5>

            </div>

            <div class="card-body">

                @forelse($mahasiswaPerProdi as $prodi)

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div>

                            <span class="fw-semibold">
                                {{ $prodi->nama_prodi }}
                            </span>

                            <br>

                            <small class="text-muted">
                                {{ $prodi->kode_prodi }}
                            </small>

                        </div>

                        <span class="badge bg-primary">
                            {{ $prodi->mahasiswas_count }}
                            Mahasiswa
                        </span>

                    </div>

                @empty

                    <p class="text-muted mb-0">
                        Belum ada data program studi.
                    </p>

                @endforelse

            </div>

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- MAHASISWA TERBARU --}}
{{-- ========================================= --}}

<div class="card shadow-sm">

    <div class="card-header bg-white">

        <div class="d-flex justify-content-between align-items-center">

            <h5 class="mb-0 fw-bold">
                Mahasiswa Terbaru
            </h5>

            <a
                href="{{ route('mahasiswa.index') }}"
                class="btn btn-sm btn-primary"
            >
                Lihat Semua
            </a>

        </div>

    </div>


    <div class="card-body">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>NIM</th>

                        <th>Nama</th>

                        <th>Program Studi</th>

                        <th>Jenis Kelamin</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($mahasiswaTerbaru as $mahasiswa)

                    <tr>

                        <td>
                            {{ $mahasiswa->nim }}
                        </td>

                        <td class="fw-semibold">
                            {{ $mahasiswa->nama }}
                        </td>

                        <td>
                            {{ $mahasiswa->prodi->nama_prodi }}
                        </td>

                        <td>
                            {{ $mahasiswa->jenis_kelamin }}
                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="4"
                            class="text-center text-muted py-4"
                        >
                            Belum ada data mahasiswa.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- CHART.JS --}}
{{-- ========================================= --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const labels = [

    @foreach($mahasiswaPerProdi as $prodi)

        "{{ $prodi->nama_prodi }}",

    @endforeach

];


const data = [

    @foreach($mahasiswaPerProdi as $prodi)

        {{ $prodi->mahasiswas_count }},

    @endforeach

];


const chartElement = document.getElementById(
    'mahasiswaProdiChart'
);


new Chart(chartElement, {

    type: 'bar',

    data: {

        labels: labels,

        datasets: [

            {

                label: 'Jumlah Mahasiswa',

                data: data

            }

        ]

    },

    options: {

        responsive: true,

        maintainAspectRatio: true,

        scales: {

            y: {

                beginAtZero: true,

                ticks: {

                    precision: 0

                }

            }

        }

    }

});

</script>

@endsection