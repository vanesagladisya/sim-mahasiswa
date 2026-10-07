@extends('layouts.app')

@section('title', 'Edit Program Studi')

@section('content')

<h2 class="fw-bold mb-4">Edit Program Studi</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('prodi.update', $prodi) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">
                    Kode Prodi
                </label>

                <input
                    type="text"
                    name="kode_prodi"
                    class="form-control"
                    value="{{ old('kode_prodi', $prodi->kode_prodi) }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Nama Program Studi
                </label>

                <input
                    type="text"
                    name="nama_prodi"
                    class="form-control"
                    value="{{ old('nama_prodi', $prodi->nama_prodi) }}"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="form-label">
                    Fakultas
                </label>

                <input
                    type="text"
                    name="fakultas"
                    class="form-control"
                    value="{{ old('fakultas', $prodi->fakultas) }}"
                >
            </div>

            <a href="{{ route('prodi.index') }}" class="btn btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>

        </form>

    </div>
</div>

@endsection