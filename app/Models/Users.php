<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

    protected $table = 'users';

    protected $primaryKey = 'id_users';

    protected $fillable = [
        "username",
        "password",
        "nama_lengkap",
        "email",
        "no_telp",
        "foto",
        "level",
        "blokir",
        "id_session",
        "menu_id",
        "submenu_id",
    ];
    public function transaksi()
    {
        return $this->hasOne('App\Models\TransaksiPembayaran', 'id_users');

    }
    public function simpan()
    {
        return $this->hasOne('App\Models\Simpanan', 'id_users');

    }
    public function pengajuan()
    {
        return $this->hasOne('App\Models\Pengajuan', 'id_users');

    }
    public function online()
    {
        return $this->hasOne('App\Models\Pengajuan', 'id_users');

    }
}
