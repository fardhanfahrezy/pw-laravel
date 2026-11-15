@extends('layouts.master')

@section('title', 'Edit Mahasiswa: ' . $mahasiswa->nama)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-pencil-square text-warning me-2"></i>Ubah Data Mahasiswa
                    </h5>
                    <small class="text-muted">Perbarui informasi data mahasiswa pada formulir berikut</small>
                </div>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-octagon-fill fs-5 me-2"></i>
                            <strong>Terdapat kesalahan pada input:</strong>
                        </div>
                        <ul class="mb-0 mt-2 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('mahasiswa.update', $mahasiswa) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nim" class="form-label fw-semibold">
                            Nomor Induk Mahasiswa (NIM) <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="nim"
                               id="nim"
                               class="form-control @error('nim') is-invalid @enderror"
                               value="{{ old('nim', $mahasiswa->nim) }}"
                               placeholder="Contoh: 202401001"
                               maxlength="20"
                               required>
                        @error('nim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            <div class="form-text">NIM unik maksimal 20 karakter.</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">
                            Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="nama"
                               id="nama"
                               class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama', $mahasiswa->nama) }}"
                               placeholder="Contoh: Nadia Putri"
                               maxlength="100"
                               required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="prodi" class="form-label fw-semibold">
                            Program Studi <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="prodi"
                               id="prodi"
                               class="form-control @error('prodi') is-invalid @enderror"
                               value="{{ old('prodi', $mahasiswa->prodi) }}"
                               placeholder="Contoh: D3 Teknik Informatika"
                               maxlength="100"
                               required>
                        @error('prodi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="form-label fw-semibold">
                            Alamat <span class="text-danger">*</span>
                        </label>
                        <textarea name="alamat"
                                  id="alamat"
                                  rows="3"
                                  class="form-control @error('alamat') is-invalid @enderror"
                                  placeholder="Masukkan alamat lengkap mahasiswa"
                                  required>{{ old('alamat', $mahasiswa->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="bi bi-pencil-square"></i> Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
