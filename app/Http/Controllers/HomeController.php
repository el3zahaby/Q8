<?php

namespace App\Http\Controllers;

use App\Color;
use App\DesignsCollections;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function home(){
        $products =  DesignsCollections::inRandomOrder()->paginate(8);
        $colors = Color::get()->pluck('name','id');
        return view('home.index',compact('products','colors'));
    }

    public function setLang($lang){
        App::setLocale(Str::lower($lang));
        Session::put('locale', Str::lower($lang));
        return Session::get('locale');
    }
}
