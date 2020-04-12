<?php

namespace App\Http\Controllers;

use App\Dsize;

class DsizeController extends Controller
{
    public function show()
    {
        return Dsize::all();
    }

    // public function creat(Request $request)
    // {

    //     $dsize=new Dsize();
    //     $dsize->length=$request->length;
    //     $dsize->width=$request->width;
    //     $dsize->print_price=$request->print_price;
    //     $dsize->des=$request->des;
    //     $dsize->save();
    //     return "Ok";

    // }

    public function getDsize($id)
    {
        return Dsize::find($id);


    }
    // public function update(Request $request)
    // {

    //     $dsize=Dsize::find($id);
    //     $dsize->length=$request->length;
    //     $dsize->width=$request->width;
    //     $dsize->print_price=$request->print_price;
    //     $dsize->des=$request->des;
    //     $dsize->save();
    //       return "Ok";
    // }
}
