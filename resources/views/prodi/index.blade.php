@extends('layouts.app')

@section('title', 'Program Studi')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold">Program Studi</h2>

        <p class="text-muted mb-0">
            Kelola data program studi.
        </p>
    </div>

    <a href="{{ route('prodi.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>
        Tambah Program Studi
    </a>

</div>


@if(session('success'))
    <div class="alert alert-success">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success') }}
    </div>
@endif


@if(session('error'))
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-triangle me-1"></i>
        {{ session('error') }}
    </div>
@endif


<div class="card shadow-sm">

    <div class="card-body">

        <form
            action="{{ route('prodi.index') }}"
            method="GET"
            class="row g-2 mb-4"
        >

            <div class="col-md-10">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari kode, nama prodi, atau fakultas..."
                    value="{{ request('search') }}"
                >

            </div>

            <div class="col-md-2">

                <button
                    type="submit"
                    class="btn btn-primary w-100"
                >
                    <i class="bi bi-search me-1"></i>
                    Cari
                </button>

            </div>

        </form>


        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>
                        <th>#</th>
                        <th>Kode Prodi</th>
                        <th>Nama Program Studi</th>
                        <th>Fakultas</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($prodis as $prodi)

                    <tr>

                        <td>
                            {{ $prodis->firstItem() + $loop->index }}
                        </td>

                        <td>
                            <span class="badge bg-primary">
                                {{ $prodi->kode_prodi }}
                            </span>
                        </td>

                        <td class="fw-semibold">
                            {{ $prodi->nama_prodi }}
                        </td>

                        <td>
                            {{ $prodi->fakultas ?? '-' }}
                        </td>

                        <td>

                            <div class="btn-group">

                                {{-- LIHAT DETAIL --}}

                                <a
                                    href="{{ route('prodi.show', $prodi) }}"
                                    class="btn btn-sm btn-info text-white"
                                    title="Lihat Detail"
                                >
                                    <i class="bi bi-eye"></i>
                                </a>


                                {{-- EDIT --}}

                                <a
                                    href="{{ route('prodi.edit', $prodi) }}"
                                    class="btn btn-sm btn-warning"
                                    title="Edit"
                                >
                                    <i class="bi bi-pencil"></i>
                                </a>


                                {{-- HAPUS --}}

                                <form
                                    action="{{ route('prodi.destroy', $prodi) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus program studi ini?')"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                        title="Hapus"
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
                            colspan="5"
                            class="text-center py-5 text-muted"
                        >

                            <i class="bi bi-inbox fs-1"></i>

                            <p class="mt-2">
                                Data program studi belum tersedia.
                            </p>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="mt-3">
            {{ $prodis->links() }}
        </div>

    </div>

</div>

@endsection