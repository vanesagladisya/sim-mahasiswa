@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')

<div class="mb-4">

    <h2 class="fw-bold">
        Edit Mahasiswa
    </h2>

    <p class="text-muted">
        Perbarui data mahasiswa.
    </p>

</div>


<div class="card shadow-sm">

    <div class="card-body">

        <form
            action="{{ route('mahasiswa.update', $mahasiswa) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            <div class="row g-3">

                {{-- NIM --}}
                <div class="col-md-6">

                    <label class="form-label">
                        NIM
                    </label>

                    <input
                        type="text"
                        name="nim"
                        class="form-control @error('nim') is-invalid @enderror"
                        value="{{ old('nim', $mahasiswa->nim) }}"
                    >

                    @error('nim')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>


                {{-- NAMA --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Nama
                    </label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $mahasiswa->nama) }}"
                    >

                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>


                {{-- PROGRAM STUDI --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Program Studi
                    </label>

                    <select
                        name="prodi_id"
                        class="form-select @error('prodi_id') is-invalid @enderror"
                    >

                        <option value="">
                            Pilih Program Studi
                        </option>

                        @foreach($prodis as $prodi)

                        <option
                            value="{{ $prodi->id }}"
                            @selected(old('prodi_id', $mahasiswa->prodi_id) == $prodi->id)
                        >
                            {{ $prodi->nama_prodi }}
                        </option>

                        @endforeach

                    </select>

                    @error('prodi_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>


                {{-- JENIS KELAMIN --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Jenis Kelamin
                    </label>

                    <select
                        name="jenis_kelamin"
                        class="form-select"
                    >

                        <option value="">
                            Pilih
                        </option>

                        <option
                            value="Laki-laki"
                            @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'Laki-laki')
                        >
                            Laki-laki
                        </option>

                        <option
                            value="Perempuan"
                            @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'Perempuan')
                        >
                            Perempuan
                        </option>

                    </select>

                </div>


                {{-- TANGGAL LAHIR --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Tanggal Lahir
                    </label>

                    <input
                        type="date"
                        name="tanggal_lahir"
                        class="form-control"
                        value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir?->format('Y-m-d')) }}"
                    >

                </div>


                {{-- TELEPON --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Telepon
                    </label>

                    <input
                        type="text"
                        name="telepon"
                        class="form-control"
                        value="{{ old('telepon', $mahasiswa->telepon) }}"
                    >

                </div>


                {{-- EMAIL --}}
                <div class="col-md-12">

                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $mahasiswa->email) }}"
                    >

                </div>


                {{-- ALAMAT --}}
                <div class="col-md-12">

                    <label class="form-label">
                        Alamat
                    </label>

                    <textarea
                        name="alamat"
                        class="form-control"
                        rows="4"
                    >{{ old('alamat', $mahasiswa->alamat) }}</textarea>

                </div>

            </div>


            <div class="mt-4">

                <a
                    href="{{ route('mahasiswa.show', $mahasiswa) }}"
                    class="btn btn-secondary"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="bi bi-save me-1"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection