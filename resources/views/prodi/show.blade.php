@extends('layouts.app')

@section('title', 'Detail Program Studi')

@section('content')

<h2 class="fw-bold mb-4">Detail Program Studi</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <p>
            <strong>Kode Prodi:</strong>
            {{ $prodi->kode_prodi }}
        </p>

        <p>
            <strong>Nama Program Studi:</strong>
            {{ $prodi->nama_prodi }}
        </p>

        <p>
            <strong>Fakultas:</strong>
            {{ $prodi->fakultas ?? '-' }}
        </p>

        <p>
            <strong>Jumlah Mahasiswa:</strong>
            {{ $prodi->mahasiswas->count() }} Mahasiswa
        </p>

        <hr>

        <a href="{{ route('prodi.edit', $prodi) }}" class="btn btn-warning">
            Edit
        </a>

        <a href="{{ route('prodi.index') }}" class="btn btn-secondary">
            Kembali
        </a>

    </div>
</div>

@endsection