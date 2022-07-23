<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Anggota extends Authenticatable
{
    protected $table = "tb_anggota";
    protected $primaryKey = "id_anggota";
    protected $fillable = [
        "nik", "nama_anggota", "alamat", "pekerjaan", "tgl_masuk", "telp", "tempat_lahir", "tgl_lahir", "id_users", "tgl_input", "foto"
    ];
    public function pengambilan()
    {
        return $this->hasOne('App\Models\Pengambilan', 'id_anggota');
    }
    public function pengajuan()
    {
        return $this->hasOne('App\Models\Pengajuan', 'id_anggota');
    }
    public function simpanan()
    {
        return $this->hasOne('App\Models\Simpanan', 'id_anggota');
    }
    public function pinjaman()
    {
        return $this->hasOne('App\Models\Pinjaman', 'id_anggota');
    }
}
