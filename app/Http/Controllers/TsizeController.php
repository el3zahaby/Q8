<?php

namespace App\Http\Controllers;

use App\Tsize;

class TsizeController extends Controller
{
    public function show()
    {
        return Tsize::all();
    }

    public function getTsize($id)
    {
        return Tsize::find($id);
    }
}
