<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false; // Karena primary key berupa NIM (string / non-incrementing)
    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'nama',
        'prodi',
        'angkatan',
    ];
}