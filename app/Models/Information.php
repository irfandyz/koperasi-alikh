<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'tb_information';

    protected $primaryKey = 'information_id';

    protected $fillable = [
        'information',
        'id_users',
        'bg_color',
        'bg_image',
        'created_at',
        'updated_at',
    ];
}
