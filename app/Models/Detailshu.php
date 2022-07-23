<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detailshu extends Model
{
    protected $table = "detail_shu";
    protected $primaryKey = "id_detailshu";
    protected $fillable = [
        "nama_variabel", "prosentasi", 'id_shu'
    ];
    public function shu()
    {
        return $this->belongsTo('App\Models\Shu', 'id_shu');
    }
}
