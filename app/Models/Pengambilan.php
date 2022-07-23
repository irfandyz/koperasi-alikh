<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengambilan extends Model
{

    protected $table = 'tb_pengambilan';

    protected $primaryKey = 'id_pengambilan';

    protected $fillable = [
        "id_anggota",
        "id_anggota",
        "id_users",
        "besar_ambil",
        "id_jenispengambilan",
        "tgl_pengambilan",
    ];
    public function jenispengambilan()
    {
        return $this->belongsTo('App\Models\Jenispengambilan', 'id_jenispengambilan');
    }
    public function anggota()
    {
        return $this->belongsTo('App\Models\Anggota', 'id_anggota');
    }
}
