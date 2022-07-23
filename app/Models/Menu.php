<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'tag_id','menuName','menuUrl','menuIcon','sequence','main'
    ];
    public function tag(){
        return $this->belongsTo('App\Models\Tag');
    }
}
