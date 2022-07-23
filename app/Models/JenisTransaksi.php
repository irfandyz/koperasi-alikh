<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisTransaksi extends Model
{
    protected $table = "jenistransaksi";
    protected $primaryKey = "id_jenis_transaksi";
    protected $fillable = [
        "nama_jenis_transaksi", "ket",
    ];
}
