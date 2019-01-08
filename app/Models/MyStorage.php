<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyStorage extends Model
{
    protected $table = 'my_storage';

    protected $primaryKey  = 'key';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'key',
        'value',
    ];

}