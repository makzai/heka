<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index(Request $request)
    {
        $cid = $request->input('cid');
        return Information::where('category_id', $cid)
            ->orderBy('sort', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
    }
}
