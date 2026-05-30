<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database
    protected $table = 'certificates';

    // Mendaftarkan kolom yang boleh diisi manual lewat form input
   protected $fillable = [
    'certificate_number',
    'ring_number',
    'hatch_date',
    'bird_type',
    'gender',
    'ring_color',
    'father_breeder',
    'mother_breeder',
    'farm_name',
    'phone_1',
    'phone_2',
    'photo_path',
    'video_path',
];
}