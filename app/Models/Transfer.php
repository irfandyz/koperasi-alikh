<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $table = 'tb_transfer';

    protected $primaryKey = "id_transfer";

    protected $fillable = [
        "kode_transfer",
        "jumlah",
        "id_pengirim",
        "id_penerima",
    ];
}
