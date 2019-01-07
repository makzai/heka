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
        return rtrim(config('filesystems.disks.qiniu.domains.default'), '/').'/'.
            ltrim($this->attributes['path'], '/');
    }
}
