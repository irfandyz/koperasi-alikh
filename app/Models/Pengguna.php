<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pengguna extends Authenticatable
{
    protected $table = "tb_pengguna";
    protected $primaryKey = "id_pengguna";
    protected $fillable = [
        "nama_pengguna",
        "username",
        "password",
        "no_hp",
        "tanggal_lahir",
        "email",
        "foto_ktp",
        "kode_pin",
    ];
}
