<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPembayaran extends Model
{
    protected $table = "transaksi";
    protected $primaryKey = "id_transaksi";
    protected $fillable = [
        "kode_transaksi", "id_jenis_transaksi", "nominal", "keterangan", "id_bank", "created_at", "updated_at", 'id_user',
    ];
    public function kategori()
    {
        return $this->belongsTo('App\Models\KategoriTransaksi', 'id_kategori_transaksi');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'id_user');
    }
}
