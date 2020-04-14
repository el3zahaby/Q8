<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{

    public function index(){
        return view('dash.dashboard');
    }

    public function login(){
        if (Auth::check()) return redirect('/');
        return view('dash.user-pages.login');
        // return view('admin.pages.user-pages.login');
    }
}
