<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenissimpanan extends Model
{
    protected $table = 'tb_jenissimpanan';

    protected $primaryKey = "id_jenissimpanan";

    protected $fillable = [
        "nama_simpanan",
        "besar_simpanan",
        "id_users",
        "tgl_entri",
    ];
    public function simpanan()
    {
        return $this->hasOne('App\Models\Simpanan', 'id_jenissimpanan');
    }
}
