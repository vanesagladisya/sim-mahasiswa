@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold">
            Detail Mahasiswa
        </h2>

        <p class="text-muted">
            Informasi lengkap mahasiswa.
        </p>
    </div>

    <div>

        <a
            href="{{ route('mahasiswa.edit', $mahasiswa) }}"
            class="btn btn-warning"
        >
            <i class="bi bi-pencil me-1"></i>
            Edit
        </a>

        <a
            href="{{ route('mahasiswa.index') }}"
            class="btn btn-secondary"
        >
            Kembali
        </a>

    </div>

</div>


<div class="card shadow-sm">

    <div class="card-body">

        <div class="row g-4">

            <div class="col-md-6">

                <label class="text-muted">
                    NIM
                </label>

                <h5>
                    {{ $mahasiswa->nim }}
                </h5>

            </div>


            <div class="col-md-6">

                <label class="text-muted">
                    Nama
                </label>

                <h5>
                    {{ $mahasiswa->nama }}
                </h5>

            </div>


            <div class="col-md-6">

                <label class="text-muted">
                    Program Studi
                </label>

                <h5>
                    {{ $mahasiswa->prodi->nama_prodi }}
                </h5>

            </div>


            <div class="col-md-6">

                <label class="text-muted">
                    Jenis Kelamin
                </label>

                <h5>
                    {{ $mahasiswa->jenis_kelamin }}
                </h5>

            </div>


            <div class="col-md-6">

                <label class="text-muted">
                    Tanggal Lahir
                </label>

                <h5>
                    {{ $mahasiswa->tanggal_lahir
                        ? $mahasiswa->tanggal_lahir->format('d-m-Y')
                        : '-' }}
                </h5>

            </div>


            <div class="col-md-6">

                <label class="text-muted">
                    Telepon
                </label>

                <h5>
                    {{ $mahasiswa->telepon ?? '-' }}
                </h5>

            </div>


            <div class="col-md-12">

                <label class="text-muted">
                    Email
                </label>

                <h5>
                    {{ $mahasiswa->email ?? '-' }}
                </h5>

            </div>


            <div class="col-md-12">

                <label class="text-muted">
                    Alamat
                </label>

                <h5>
                    {{ $mahasiswa->alamat ?? '-' }}
                </h5>

            </div>

        </div>

    </div>

</div>

@endsection