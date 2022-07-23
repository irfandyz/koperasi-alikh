<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenor extends Model
{
    protected $table = "tb_tenor";
    protected $primaryKey = "id_tenor";
    protected $fillable = [
        "id_jenispinjaman", "lama_tenor",
    ];
    public function pengajuan()
    {
        return $this->hasOne('App\Models\Pengajuan', 'id_tenor');
    }
    public function jenispinjaman()
    {
        return $this->belongsTo('App\Models\Jenispinjaman', 'id_jenispinjaman');
    }
}
