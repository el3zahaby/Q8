<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use \Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmMail;

class UserController extends Controller
{
    public function show()
    {
        return User::get();
    }

    public function create(Request $request)
    {
        if (!$request->is_trader) {
            $this->validate($request, [
                'firstname' => 'required|max:255',
                'lastname' => 'required|max:255',
                'age' => 'max:60',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|unique:users,phone',
            ]);
        }else{
            $this->validate($request, [
                'firstname' => 'required|max:255',
                'lastname' => 'required|max:255',
                'age' => 'max:60',
                'BankName' => 'required',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|unique:users,phone',
            ]);
        }


        $user = new User();
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->age = $request->age;
        $user->Bank_Name = $request->BankName;
        $user->IBAN_Bank = $request->BankIBAN;
        $user->name_on_BankCard = $request->name_on_BankCard;
        $user->save();
        if (!$request->is_trader) {
            $user->assignRole('user');
        }

        $user->sendEmailVerificationNotification();

//        Mail::to($user->email)->send(new ConfirmMail);
//        $this->notify(new \App\Notifications\CustomVerifyEmail);

        return "Ok";

    }

    public function update(Request $request)
    {
        $user = User::find(auth()->id());

        if (isset($request->noUpdate)){
            $reqMoney = $request->reqMoney;
            $user->settings = json_encode(['reqMoney' =>$reqMoney,]);
        }else{
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
        }
        $user->save();
        return "Ok";
    }

    public function myOrder($id = null){
        $id = $id ?? auth()->id();
        $orders = Order::where('user_id',$id)->get();
        return $orders;
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
