<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sementara extends Model
{
    use HasFactory;
    protected $table = 'pinjaman_sementara';
    protected $fillable = [
        'id_anggota',
        'nip',
        'no_kas',
        'tgl_mulai',
        'besar_pinjaman',
        'besar_pembayaran',
        'keterangan'
    ];
}
