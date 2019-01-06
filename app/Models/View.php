<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $table = 'view';

    protected $fillable = [
        'name',
        'sort',
        'title',
        'album_id',
        'intro',
        'card_img',
        'card_intro',
    ];

    public function album()
    {
        return $this->hasOne(Album::class);
    }

}
