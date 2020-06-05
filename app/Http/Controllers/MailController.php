<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        //dd(config('mail'));
        Mail::to('engahmed0403515671@gmail.com')->send(new TestMail);
        echo "ok";
        // return;
    }
}
