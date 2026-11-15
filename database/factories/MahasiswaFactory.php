<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    protected $model = Mahasiswa::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nim' => fake()->unique()->numerify('2024#####'),
            'nama' => fake()->name(),
            'prodi' => fake()->randomElement([
                'D3 Teknik Informatika',
                'D4 Rekayasa Perangkat Lunak',
                'D3 Manajemen Informatika',
                'D3 Komputerisasi Akuntansi',
            ]),
            'alamat' => fake()->address(),
        ];
    }
}
