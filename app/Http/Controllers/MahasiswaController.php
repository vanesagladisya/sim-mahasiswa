<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan daftar mahasiswa.
     */
    public function index(Request $request)
    {
        $query = Mahasiswa::with('prodi');

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan prodi
        if ($request->filled('prodi_id')) {
            $query->where('prodi_id', $request->prodi_id);
        }

        $mahasiswas = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $prodis = Prodi::orderBy('nama_prodi')->get();

        return view('mahasiswa.index', compact(
            'mahasiswas',
            'prodis'
        ));
    }

    /**
     * Form tambah mahasiswa.
     */
    public function create()
    {
        $prodis = Prodi::orderBy('nama_prodi')->get();

        return view('mahasiswa.create', compact('prodis'));
    }

    /**
     * Menyimpan mahasiswa.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => [
                'required',
                'string',
                'max:30',
                'unique:mahasiswas,nim',
            ],

            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'jenis_kelamin' => [
                'required',
                Rule::in([
                    'Laki-laki',
                    'Perempuan',
                ]),
            ],

            'tanggal_lahir' => [
                'nullable',
                'date',
            ],

            'alamat' => [
                'nullable',
                'string',
            ],

            'telepon' => [
                'nullable',
                'string',
                'max:20',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'prodi_id' => [
                'required',
                'exists:prodis,id',
            ],
        ]);

        Mahasiswa::create($validated);

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail mahasiswa.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('prodi');

        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Form edit mahasiswa.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $prodis = Prodi::orderBy('nama_prodi')->get();

        return view('mahasiswa.edit', compact(
            'mahasiswa',
            'prodis'
        ));
    }

    /**
     * Update mahasiswa.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nim' => [
                'required',
                'string',
                'max:30',
                Rule::unique('mahasiswas', 'nim')
                    ->ignore($mahasiswa->id),
            ],

            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'jenis_kelamin' => [
                'required',
                Rule::in([
                    'Laki-laki',
                    'Perempuan',
                ]),
            ],

            'tanggal_lahir' => [
                'nullable',
                'date',
            ],

            'alamat' => [
                'nullable',
                'string',
            ],

            'telepon' => [
                'nullable',
                'string',
                'max:20',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'prodi_id' => [
                'required',
                'exists:prodis,id',
            ],
        ]);

        $mahasiswa->update($validated);

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Hapus mahasiswa.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}