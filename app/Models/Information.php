<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'information';

    protected $fillable = [
        'name',
        'sort',
        'category_id',
        'label',
        'intro',
        'head_img',
        'type',
        'link',
        'long_img',
        'detail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $appends = ['api_head_img', 'api_long_img'];

    public function getApiHeadImgAttribute()
    {
        return rtrim(env('CDN_HOST', 'http://fuwu.saasphp.cn'), '/').'/'.
            ltrim($this->attributes['head_img'], '/');
    }

    public function getApiLongImgAttribute()
    {
        return rtrim(env('CDN_HOST', 'http://fuwu.saasphp.cn'), '/').'/'.
            ltrim($this->attributes['long_img'], '/');
    }
}
