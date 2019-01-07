<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    protected $table = 'img';

    protected $fillable = [
        'album_id',
        'sort',
        'path',
    ];

}