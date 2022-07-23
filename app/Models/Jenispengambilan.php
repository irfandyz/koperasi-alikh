<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenispengambilan extends Model
{
    protected $table = "tb_jenispengambilan";
    protected $primaryKey = "id_jenispengambilan";
    protected $fillable = [
        "nama_jenispengambilan", "minimum_pengambilan",
    ];

    public function pengambilan()
    {
        return $this->hasOne('App\Models\Pengambilan', 'id_jenispengambilan');
    }
}
