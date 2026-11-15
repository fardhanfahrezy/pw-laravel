@extends('layouts.master')

@section('title', 'Daftar Mahasiswa')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                <div>
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-people-fill text-primary me-2"></i>Daftar Data Mahasiswa
                    </h5>
                    <small class="text-muted">Kelola data mahasiswa menggunakan Eloquent ORM</small>
                </div>
                <div>
                    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Mahasiswa
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
                @if($mahasiswa->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-inbox text-secondary" style="font-size: 3.5rem;"></i>
                        <h6 class="mt-3 text-secondary fw-semibold">Belum Ada Data Mahasiswa</h6>
                        <p class="text-muted mb-3">Silakan tambahkan data mahasiswa baru untuk memulai.</p>
                        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle"></i> Tambah Mahasiswa Pertama
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 5%;">No</th>
                                    <th scope="col" style="width: 15%;">NIM</th>
                                    <th scope="col" style="width: 25%;">Nama Mahasiswa</th>
                                    <th scope="col" style="width: 20%;">Program Studi</th>
                                    <th scope="col" style="width: 25%;">Alamat</th>
                                    <th scope="col" class="text-center" style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mahasiswa as $mhs)
                                    <tr>
                                        <td class="text-center fw-medium text-muted">{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark border font-monospace px-2 py-1">
                                                {{ $mhs->nim }}
                                            </span>
                                        </td>
                                        <td class="fw-semibold text-dark">
                                            <i class="bi bi-person-circle text-secondary me-1"></i>
                                            {{ $mhs->nama }}
                                        </td>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">
                                                {{ $mhs->prodi }}
                                            </span>
                                        </td>
                                        <td class="text-secondary">{{ $mhs->alamat }}</td>
                                        <td class="text-center">
                                            <div class="d-inline-flex gap-1">
                                                <a href="{{ route('mahasiswa.edit', $mhs) }}" class="btn btn-warning btn-sm text-white" title="Ubah Data">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>

                                                <form action="{{ route('mahasiswa.destroy', $mhs) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus Data">
                                                        <i class="bi bi-trash-fill"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white text-muted small py-2 px-3 border-top">
                        Total Mahasiswa: <strong class="text-dark">{{ $mahasiswa->count() }}</strong> data
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
