<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'tagName'
    ];
    public function menu(){
        return $this->hasOne('App\Models\Menu');
    }
}
