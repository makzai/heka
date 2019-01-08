<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use App\Models\MyStorage;
use App\Models\Storage;
use App\Models\Wish;
use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function keywords()
    {
        $k = Keyword::get();

        $w = [];
        foreach ($k as $v) {
            $w[$v->animal.$v->constellation] = $v->word;
        }

        return $w;
    }

    public function wishes()
    {
        return Wish::get();
    }

    public function set(Request $request)
    {
        $str = $request->input('str');
        if (!is_string($str)) {
            return '';
        }
        $key = md5($str);
        $ms = MyStorage::findOrNew($key);
        $ms->key = $key;
        $ms->value = $str;
        $ms->save();
        return $key;
    }

    public function get(Request $request)
    {
        $key = $request->input('key');
        $ms = MyStorage::find($key);
        return empty($ms) ? '' : $ms->value;
    }
}
