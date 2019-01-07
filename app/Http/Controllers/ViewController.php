<?php

namespace App\Http\Controllers;

use App\Models\View;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index(Request $request)
    {
        return View::orderBy('sort', 'desc')->get();
    }

    public function show(Request $request, $id)
    {
        return View::with('album.imgs')->find($id);
    }
}
