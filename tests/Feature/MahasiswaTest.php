<?php

use App\Models\Mahasiswa;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('root route redirects to mahasiswa index', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('mahasiswa.index'));
});

test('index page displays empty state when there are no mahasiswa', function () {
    Mahasiswa::query()->delete();

    $response = $this->get(route('mahasiswa.index'));

    $response->assertOk();
    $response->assertSee('Belum Ada Data Mahasiswa');
    $response->assertSee('Tambah Mahasiswa Pertama');
});

test('index page displays mahasiswa list', function () {
    $mhs = Mahasiswa::factory()->create([
        'nim' => '23010199',
        'nama' => 'Ahmad Fauzi',
        'prodi' => 'D3 Teknik Informatika',
        'alamat' => 'Jl. Merdeka No. 12',
    ]);

    $response = $this->get(route('mahasiswa.index'));

    $response->assertOk();
    $response->assertSee('23010199');
    $response->assertSee('Ahmad Fauzi');
    $response->assertSee('D3 Teknik Informatika');
    $response->assertSee('Jl. Merdeka No. 12');
});

test('create page can be rendered', function () {
    $response = $this->get(route('mahasiswa.create'));

    $response->assertOk();
    $response->assertSee('Tambah Mahasiswa Baru');
    $response->assertSee('Nomor Induk Mahasiswa (NIM)');
});

test('can store new mahasiswa with valid data', function () {
    $data = [
        'nim' => '24030101',
        'nama' => 'Dewi Lestari',
        'prodi' => 'D4 Rekayasa Perangkat Lunak',
        'alamat' => 'Jl. Pahlawan No. 7, Surabaya',
    ];

    $response = $this->post(route('mahasiswa.store'), $data);

    $response->assertRedirect(route('mahasiswa.index'));
    $response->assertSessionHas('success', 'Data mahasiswa berhasil ditambahkan.');

    $this->assertDatabaseHas('mahasiswa', [
        'nim' => '24030101',
        'nama' => 'Dewi Lestari',
        'prodi' => 'D4 Rekayasa Perangkat Lunak',
        'alamat' => 'Jl. Pahlawan No. 7, Surabaya',
    ]);
});

test('validates required fields when storing mahasiswa', function () {
    $response = $this->from(route('mahasiswa.create'))
        ->post(route('mahasiswa.store'), [
            'nim' => '',
            'nama' => '',
            'prodi' => '',
            'alamat' => '',
        ]);

    $response->assertRedirect(route('mahasiswa.create'));
    $response->assertSessionHasErrors(['nim', 'nama', 'prodi', 'alamat']);
});

test('cannot store mahasiswa with duplicate nim', function () {
    Mahasiswa::factory()->create(['nim' => '24030102']);

    $response = $this->from(route('mahasiswa.create'))
        ->post(route('mahasiswa.store'), [
            'nim' => '24030102',
            'nama' => 'Student Duplicate',
            'prodi' => 'D3 Teknik Informatika',
            'alamat' => 'Alamat test',
        ]);

    $response->assertRedirect(route('mahasiswa.create'));
    $response->assertSessionHasErrors(['nim']);
});

test('edit page can be rendered with current student data', function () {
    $mhs = Mahasiswa::factory()->create([
        'nim' => '24030103',
        'nama' => 'Rian Hidayat',
    ]);

    $response = $this->get(route('mahasiswa.edit', $mhs));

    $response->assertOk();
    $response->assertSee('24030103');
    $response->assertSee('Rian Hidayat');
});

test('can update mahasiswa data and keep current nim', function () {
    $mhs = Mahasiswa::factory()->create([
        'nim' => '24030104',
        'nama' => 'Nama Lama',
        'prodi' => 'D3 Teknik Informatika',
        'alamat' => 'Alamat Lama',
    ]);

    $response = $this->put(route('mahasiswa.update', $mhs), [
        'nim' => '24030104',
        'nama' => 'Nama Baru Yang Diperbarui',
        'prodi' => 'D4 Rekayasa Perangkat Lunak',
        'alamat' => 'Alamat Baru',
    ]);

    $response->assertRedirect(route('mahasiswa.index'));
    $response->assertSessionHas('success', 'Data mahasiswa berhasil diperbarui.');

    $this->assertDatabaseHas('mahasiswa', [
        'id' => $mhs->id,
        'nim' => '24030104',
        'nama' => 'Nama Baru Yang Diperbarui',
        'prodi' => 'D4 Rekayasa Perangkat Lunak',
        'alamat' => 'Alamat Baru',
    ]);
});

test('cannot update mahasiswa with nim that belongs to another student', function () {
    $first = Mahasiswa::factory()->create(['nim' => '24030105']);
    $second = Mahasiswa::factory()->create(['nim' => '24030106']);

    $response = $this->from(route('mahasiswa.edit', $second))
        ->put(route('mahasiswa.update', $second), [
            'nim' => '24030105', // trying to steal first student's nim
            'nama' => 'Update Attempt',
            'prodi' => 'D3 Teknik Informatika',
            'alamat' => 'Alamat test',
        ]);

    $response->assertRedirect(route('mahasiswa.edit', $second));
    $response->assertSessionHasErrors(['nim']);
});

test('can delete mahasiswa', function () {
    $mhs = Mahasiswa::factory()->create(['nim' => '24030107']);

    $response = $this->delete(route('mahasiswa.destroy', $mhs));

    $response->assertRedirect(route('mahasiswa.index'));
    $response->assertSessionHas('success', 'Data mahasiswa berhasil dihapus.');

    $this->assertDatabaseMissing('mahasiswa', [
        'id' => $mhs->id,
    ]);
});
