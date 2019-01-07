<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'album';

    protected $fillable = [
        'name',
    ];

    public function imgs()
    {
        return $this->hasMany(Img::class);
    }
}
