<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{

    protected $table = 'tb_pengajuan';

    protected $primaryKey = 'id_pengajuan';

    protected $fillable = [
        "tgl_pengajuan",
        "id_anggota",
        "id_tenor",
        "besar_pinjam",
        "id_users",
        "create_up",
    ];
    public function anggota()
    {
        return $this->belongsTo('App\Models\Anggota', 'id_anggota');
    }
    public function tenor()
    {
        return $this->belongsTo('App\Models\Tenor', 'id_tenor');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'id_users');
    }
}
