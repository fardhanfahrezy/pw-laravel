<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::query()->upsert([
            [
                'nim' => '22030001',
                'nama' => 'Nadia Putri',
                'prodi' => 'D3 Teknik Informatika',
                'alamat' => 'Jl. Merdeka No. 10, Bandung',
            ],
            [
                'nim' => '22030002',
                'nama' => 'Zahra Amelia',
                'prodi' => 'D4 Rekayasa Perangkat Lunak',
                'alamat' => 'Jl. Sudirman No. 45, Jakarta',
            ],
            [
                'nim' => '22030003',
                'nama' => 'Budi Santoso',
                'prodi' => 'D3 Keperawatan',
                'alamat' => 'Jl. Diponegoro No. 12, Surabaya',
            ],
        ], ['nim']);
    }
}
