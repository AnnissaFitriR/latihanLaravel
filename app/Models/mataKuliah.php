<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mataKuliah extends Model
{
    use HasFactory;

    // Nama tabel (opsional, default = "mataKuliah" -> jamak)
    protected $table = 'mataKuliah';

    // Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'namaMatkul',
        'deskripsi',
    ];
}
