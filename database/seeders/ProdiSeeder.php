<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        $daftarProdi = [
            ['kode_prodi' => 'D3TI', 'nama_prodi' => 'Teknik Informatika', 'jenjang' => 'D3'],
            ['kode_prodi' => 'D3TM', 'nama_prodi' => 'Teknik Mesin', 'jenjang' => 'D3'],
            ['kode_prodi' => 'D3TPPI', 'nama_prodi' => 'Teknik Pendingin dan Tata Udara', 'jenjang' => 'D3'],
            ['kode_prodi' => 'D4RPL', 'nama_prodi' => 'Rekayasa Perangkat Lunak', 'jenjang' => 'D4'],
            ['kode_prodi' => 'D4RPM', 'nama_prodi' => 'Perancangan Manufaktur', 'jenjang' => 'D4'],
            ['kode_prodi' => 'D4TRPE', 'nama_prodi' => 'Teknologi Rekayasa Pembangkit Energi', 'jenjang' => 'D4'],
        ];

        Prodi::query()->upsert($daftarProdi, ['kode_prodi']);
    }
}