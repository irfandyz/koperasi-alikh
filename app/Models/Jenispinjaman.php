<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenispinjaman extends Model
{
    protected $table = 'tb_jenispinjaman';

    protected $primaryKey = "id_jenispinjaman";

    protected $fillable = [
        "nama_pinjaman",
        "lama_angsuran",
        "maks_pinjaman",
        "bunga",
        "id_users",
        "tgl_entri",
    ];
    public function tenor()
    {
        return $this->hasOne('App\Models\Tenor', 'id_jenispinjaman');
    }
    public function pinjaman()
    {
        return $this->hasOne('App\Models\Pinjaman', 'id_jenispinjaman');
    }
}
