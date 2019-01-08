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
        'main_img',
        'intro',
        'card_img',
        'card_intro',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    protected $appends = ['api_main_img', 'api_card_img'];

    public function getApiMainImgAttribute()
    {
        return rtrim(env('CDN_HOST', 'http://fuwu.saasphp.cn'), '/').'/'.
            ltrim($this->attributes['main_img'], '/');
    }

    public function getApiCardImgAttribute()
    {
        return rtrim(env('CDN_HOST', 'http://fuwu.saasphp.cn'), '/').'/'.
            ltrim($this->attributes['card_img'], '/');
    }
}
