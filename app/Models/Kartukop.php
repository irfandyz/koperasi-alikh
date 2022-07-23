<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Kartukop extends Authenticatable
{
    protected $table = "tb_kartukop";
    protected $primaryKey = "id_kartu";
    protected $fillable = [
        "id_anggota", "nomor_kartu", "dibuat", "berakhir", "primary_color", "secondary_color",
    ];
}
