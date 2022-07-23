<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Banner extends Authenticatable
{
    protected $table = "mobile_banner";
    protected $primaryKey = "id_banner";
    protected $fillable = [
        "banner_name", "aktif",
    ];
}
