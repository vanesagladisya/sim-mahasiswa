@extends('layouts.app')

@section('title', 'Tambah Program Studi')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold">Tambah Program Studi</h2>

        <p class="text-muted mb-0">
            Tambahkan data program studi baru.
        </p>
    </div>

    <a href="{{ route('prodi.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i>
        Kembali
    </a>

</div>

<div class="card shadow-sm">

    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">

                <strong>Terjadi kesalahan:</strong>

                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif

        <form action="{{ route('prodi.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label for="kode_prodi" class="form-label fw-semibold">
                    Kode Prodi
                </label>

                <input
                    type="text"
                    id="kode_prodi"
                    name="kode_prodi"
                    class="form-control @error('kode_prodi') is-invalid @enderror"
                    value="{{ old('kode_prodi') }}"
                    placeholder="Contoh: TI"
                    maxlength="20"
                    required
                >

                @error('kode_prodi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="mb-3">

                <label for="nama_prodi" class="form-label fw-semibold">
                    Nama Program Studi
                </label>

                <input
                    type="text"
                    id="nama_prodi"
                    name="nama_prodi"
                    class="form-control @error('nama_prodi') is-invalid @enderror"
                    value="{{ old('nama_prodi') }}"
                    placeholder="Contoh: Teknik Informatika"
                    maxlength="255"
                    required
                >

                @error('nama_prodi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="mb-4">

                <label for="fakultas" class="form-label fw-semibold">
                    Fakultas
                </label>

                <input
                    type="text"
                    id="fakultas"
                    name="fakultas"
                    class="form-control @error('fakultas') is-invalid @enderror"
                    value="{{ old('fakultas') }}"
                    placeholder="Contoh: Fakultas Teknologi Informasi"
                    maxlength="255"
                >

                @error('fakultas')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="d-flex gap-2">

                <a
                    href="{{ route('prodi.index') }}"
                    class="btn btn-secondary"
                >
                    <i class="bi bi-x-circle me-1"></i>
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="bi bi-save me-1"></i>
                    Simpan Program Studi
                </button>

            </div>

        </form>

    </div>

</div>

@endsection