<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    protected $table = "tb_tabungan";

    protected $primaryKey = "id_tabungan";

    protected $filled = [
        "id_anggota",
        "tgl_tabungan",
        "besar_tabungan",
        "id_users",
        "create_up",
    ];
}
