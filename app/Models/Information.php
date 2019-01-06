<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'information';

    protected $fillable = [
        'name',
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
}
