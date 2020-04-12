<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{

    public function index(){
        return view('admin.dashboard');
    }

    public function login(){
        if (Auth::check()) return redirect('/');
        return view('admin.pages.user-pages.login');
    }
}
