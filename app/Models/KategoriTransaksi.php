<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriTransaksi extends Model
{
    protected $table = "kategori_transaksi";
    protected $primaryKey = "id_kategori_transaksi";
    protected $fillable = [
        "nama_kategori", "id_jenis_transaksi", 'kode',
    ];
    public function transaksi()
    {
        return $this->hasOne('App\Models\TransaksiPembayaran', 'id_kategori_transaksi');
    }
}
