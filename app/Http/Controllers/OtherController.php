<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
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
}
