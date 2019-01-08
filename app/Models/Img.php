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

    protected $appends = ['api_path'];

    public function getApiPathAttribute()
    {
        return rtrim(env('CDN_HOST', 'http://fuwu.saasphp.cn'), '/').'/'.
            ltrim($this->attributes['path'], '/');
    }
}
