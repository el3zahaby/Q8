<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //  public function show()
    // {
    //      return Message::all();
    // }

    public function creat(Request $request)
    {
        $data = request()->validate([
            'name' => 'required|min:3',
            'phone' => 'required'
        ]);
        Message::create($data);
        return "Ok";

    }


}
