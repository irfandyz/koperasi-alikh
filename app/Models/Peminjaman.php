<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = "tb_peminjaman";
    protected $primaryKey = "id_peminjaman";
    protected $fillable = [
        "id_pengajuan", "jumlah", "status",
    ];
}
