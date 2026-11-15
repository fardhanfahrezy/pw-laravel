<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan daftar seluruh data mahasiswa.
     */
    public function index(): View
    {
        $mahasiswa = Mahasiswa::latest()->get();

        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Menampilkan formulir tambah mahasiswa baru.
     */
    public function create(): View
    {
        return view('mahasiswa.create');
    }

    /**
     * Menyimpan data mahasiswa baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nim' => ['required', 'string', 'max:20', 'unique:mahasiswa,nim'],
            'nama' => ['required', 'string', 'max:100'],
            'prodi' => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string'],
        ], [
            'nim.required' => 'NIM wajib diisi.',
            'nim.max' => 'NIM maksimal 20 karakter.',
            'nim.unique' => 'NIM sudah terdaftar, gunakan NIM lain.',
            'nama.required' => 'Nama mahasiswa wajib diisi.',
            'nama.max' => 'Nama mahasiswa maksimal 100 karakter.',
            'prodi.required' => 'Program studi wajib diisi.',
            'prodi.max' => 'Program studi maksimal 100 karakter.',
            'alamat.required' => 'Alamat mahasiswa wajib diisi.',
        ]);

        Mahasiswa::create($validated);

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Menampilkan formulir untuk mengubah data mahasiswa.
     */
    public function edit(Mahasiswa $mahasiswa): View
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Memperbarui data mahasiswa di database.
     */
    public function update(Request $request, Mahasiswa $mahasiswa): RedirectResponse
    {
        $validated = $request->validate([
            'nim' => [
                'required',
                'string',
                'max:20',
                Rule::unique('mahasiswa', 'nim')->ignore($mahasiswa->id),
            ],
            'nama' => ['required', 'string', 'max:100'],
            'prodi' => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string'],
        ], [
            'nim.required' => 'NIM wajib diisi.',
            'nim.max' => 'NIM maksimal 20 karakter.',
            'nim.unique' => 'NIM sudah terdaftar pada mahasiswa lain.',
            'nama.required' => 'Nama mahasiswa wajib diisi.',
            'nama.max' => 'Nama mahasiswa maksimal 100 karakter.',
            'prodi.required' => 'Program studi wajib diisi.',
            'prodi.max' => 'Program studi maksimal 100 karakter.',
            'alamat.required' => 'Alamat mahasiswa wajib diisi.',
        ]);

        $mahasiswa->update($validated);

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Menghapus data mahasiswa dari database.
     */
    public function destroy(Mahasiswa $mahasiswa): RedirectResponse
    {
        $mahasiswa->delete();

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
