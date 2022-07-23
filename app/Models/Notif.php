<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    use HasFactory;
    protected $table = "tb_notif";
    protected $primaryKey = "id_notif";
    protected $fillable = [
        'id_anggota','keterangan'
    ];
}
