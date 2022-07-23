<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendis extends Model
{
    use HasFactory;
    protected $table = 'pinjaman_pendis';
    protected $fillable = [
        'id_anggota','nip','pokok_jasa','no_kas','tgl_mulai','tgl_selesai','tenor'
    ];
}
