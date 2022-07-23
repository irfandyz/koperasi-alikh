<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    protected $table = 'tb_simpan';
    protected $primaryKey = 'id_simpan';
    protected $fillable = [
        'id_jenissimpanan',
        'besar_simpanan',
        'id_anggota',
        'id_users',
        'tgl_simpan',
        'created_up',
    ];
    public function anggota()
    {
        return $this->belongsTo('App\Models\Anggota', 'id_anggota');
    }
    public function jenissimpanan()
    {
        return $this->belongsTo('App\Models\Jenissimpanan', 'id_jenissimpanan');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'id_user');
    }
}
