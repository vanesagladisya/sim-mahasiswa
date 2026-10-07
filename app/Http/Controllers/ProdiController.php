<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProdiController extends Controller
{
    public function index(Request $request)
    {
        $query = Prodi::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('kode_prodi', 'like', "%{$search}%")
                    ->orWhere('nama_prodi', 'like', "%{$search}%")
                    ->orWhere('fakultas', 'like', "%{$search}%");
            });
        }

        $prodis = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('prodi.index', compact('prodis'));
    }

    public function create()
    {
        return view('prodi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_prodi' => [
                'required',
                'max:20',
                'unique:prodis,kode_prodi',
            ],

            'nama_prodi' => [
                'required',
                'max:255',
            ],

            'fakultas' => [
                'nullable',
                'max:255',
            ],
        ]);

        Prodi::create($validated);

        return redirect()
            ->route('prodi.index')
            ->with('success', 'Program studi berhasil ditambahkan.');
    }

    public function show(Prodi $prodi)
    {
        $prodi->load('mahasiswas');

        return view('prodi.show', compact('prodi'));
    }

    public function edit(Prodi $prodi)
    {
        return view('prodi.edit', compact('prodi'));
    }

    public function update(Request $request, Prodi $prodi)
    {
        $validated = $request->validate([
            'kode_prodi' => [
                'required',
                'max:20',
                Rule::unique('prodis', 'kode_prodi')
                    ->ignore($prodi->id),
            ],

            'nama_prodi' => [
                'required',
                'max:255',
            ],

            'fakultas' => [
                'nullable',
                'max:255',
            ],
        ]);

        $prodi->update($validated);

        return redirect()
            ->route('prodi.index')
            ->with('success', 'Program studi berhasil diperbarui.');
    }

    public function destroy(Prodi $prodi)
    {
        if ($prodi->mahasiswas()->exists()) {
            return back()->with(
                'error',
                'Prodi tidak dapat dihapus karena masih digunakan mahasiswa.'
            );
        }

        $prodi->delete();

        return redirect()
            ->route('prodi.index')
            ->with('success', 'Program studi berhasil dihapus.');
    }
}