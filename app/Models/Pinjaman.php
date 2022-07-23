<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;
    protected $fillable = [
	'id_anggota',
	'no_kas',
	'tanggal',
	'besar_pinjaman',
	'pinjaman_sementara',
	'tgl_lunas',
	'tenor',
	'jenis_pinjaman_id',
    ];
    public function jenispinjaman()
    {
        return $this->belongsTo('App\Models\Jenispinjaman', 'jenis_pinjaman_id');
    }
    public function anggota()
    {
        return $this->belongsTo('App\Models\Anggota', 'id_anggota');
    }
}
