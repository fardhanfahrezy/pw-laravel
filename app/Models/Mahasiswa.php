<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    /**
     * Nama tabel database yang terhubung dengan model.
     *
     * @var string
     */
    protected $table = 'mahasiswa';

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignment).
     *
     * @var list<string>
     */
    protected $fillable = [
        'nim',
        'nama',
        'prodi',
        'alamat',
    ];
}
