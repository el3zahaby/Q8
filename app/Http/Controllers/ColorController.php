<?php

namespace App\Http\Controllers;

use App\Color;

class ColorController extends Controller
{
    public function show()
    {
        return Color::all();
    }

}
