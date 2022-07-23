<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shu extends Model
{
    protected $table = "shu";
    protected $primaryKey = "id_shu";
    protected $fillable = [
        "tahun", "total",
    ];
    public function detialshu()
    {
        return $this->hasOne('App\Models\Detailshu', 'id_shu');
    }
}
