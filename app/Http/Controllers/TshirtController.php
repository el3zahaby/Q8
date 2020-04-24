<?php

namespace App\Http\Controllers;

use App\Color;
use App\Design;
use App\Tshirt;
use Illuminate\Http\Request;

class TshirtController extends Controller
{
    public function show()
    {
        return Tshirt::with('sizes')->get();

    }

    public function tshirtColors(Request $request, $id)
    {
        $tshirt_id = $request->tshirt_id;
        $design = Design::where('accepting', 1)->where('id', $id)->with('colors')->first();
        $tshirts = Tshirt::where('id', $tshirt_id)->with('colors')->first();
        //Get_Tshirt_Colors
        $colors_t = $tshirts->colors;
        $color_t = [];
        foreach ($colors_t as $color) {

            $color_t[] = $color->id;
        }
        //Get_Design_Colors
        $colors_d = $design->colors;
        $color_d = [];
        foreach ($colors_d as $color) {

            $color_d[] = $color->id;
        }

        $colors = array_intersect($color_t, $color_d);
        return Color::whereIn('id', $colors)->get();


    }

}
