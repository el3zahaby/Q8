<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DesignerController extends Controller
{
    public function show()
    {
        return User::where('role_id', 3)->get();
    }

    public function creat(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = new User();
        $user->random_id = Str::random(10);
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return "Ok";

    }


    public function update($id, Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::find($id);
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return "Ok";
    }
}
