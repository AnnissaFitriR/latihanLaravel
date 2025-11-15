<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDomisili extends Model
{
    use HasFactory;

    protected $table = 'master_domisili';
    protected $fillable = ['provinsi', 'kota', 'kecamatan', 'kode_pos'];
}
