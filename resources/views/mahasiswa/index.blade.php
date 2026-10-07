@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold">
            Data Mahasiswa
        </h2>

        <p class="text-muted">
            Kelola data mahasiswa.
        </p>
    </div>

    <a
        href="{{ route('mahasiswa.create') }}"
        class="btn btn-primary"
    >
        <i class="bi bi-plus-circle me-1"></i>
        Tambah Mahasiswa
    </a>

</div>


<div class="card shadow-sm">

    <div class="card-body">

        {{-- SEARCH --}}
        <form
            action="{{ route('mahasiswa.index') }}"
            method="GET"
            class="row g-2 mb-4"
        >

            <div class="col-md-6">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari NIM atau nama..."
                    value="{{ request('search') }}"
                >

            </div>


            <div class="col-md-4">

                <select
                    name="prodi_id"
                    class="form-select"
                >

                    <option value="">
                        Semua Program Studi
                    </option>

                    @foreach($prodis as $prodi)

                    <option
                        value="{{ $prodi->id }}"
                        @selected(request('prodi_id') == $prodi->id)
                    >
                        {{ $prodi->nama_prodi }}
                    </option>

                    @endforeach

                </select>

            </div>


            <div class="col-md-2">

                <button class="btn btn-primary w-100">

                    <i class="bi bi-search"></i>
                    Cari

                </button>

            </div>

        </form>


        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>#</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($mahasiswas as $mahasiswa)

                    <tr>

                        <td>
                            {{ $mahasiswas->firstItem() + $loop->index }}
                        </td>

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

                        <td>

                            <div class="btn-group">

                                <a
                                    href="{{ route('mahasiswa.show', $mahasiswa) }}"
                                    class="btn btn-sm btn-info text-white"
                                >
                                    <i class="bi bi-eye"></i>
                                </a>


                                <a
                                    href="{{ route('mahasiswa.edit', $mahasiswa) }}"
                                    class="btn btn-sm btn-warning"
                                >
                                    <i class="bi bi-pencil"></i>
                                </a>


                                <form
                                    action="{{ route('mahasiswa.destroy', $mahasiswa) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        class="btn btn-sm btn-danger"
                                    >
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-5 text-muted"
                        >

                            <i class="bi bi-inbox fs-1"></i>

                            <p class="mt-2">
                                Data mahasiswa belum tersedia.
                            </p>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        <div class="mt-3">

            {{ $mahasiswas->links() }}

        </div>

    </div>

</div>

@endsection