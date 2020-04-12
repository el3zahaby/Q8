<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        return User::get();
    }

    public function create(Request $request)
    {

        $user = new User();
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->age = $request->age;
        $user->is_trader = 0 | $request->is_trader;
        $user->Bank_Name = $request->BankName;
        $user->IBAN_Bank = $request->BankIBAN;
        $user->name_on_BankCard = $request->name_on_BankCard;
        $user->save();

        return "Ok";

    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->email = $request->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->age = $request->age;
        $user->Bank_Name = $request->BankName;
        $user->IBAN_Bank = $request->BankIBAN;
        $user->name_on_BankCard = $request->name_on_BankCard;
        $user->save();
        return "Ok";
    }

    public function getUsers()
    {
        $users = User::where('is_trader', false)->get();
    }

    public function getTraders()
    {
        $traders = User::where('is_trader', false)->get();
//        return view()
    }
}
