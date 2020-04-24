<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{

    public function index(){
        // week visits
        $date = Carbon::today()->subDays(7);
        $weekMap = [
            0 => "Sun",
            1 => 'Mon',
            2 => 'Tue',
            3 => 'Wed',
            4 => 'Thu',
            5 => 'Fri',
            6 => 'Sat',
        ];
        $visits = Visit::where('updated_at', '>=', $date)->orderBy('updated_at','asc')->get()
            ->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->updated_at)->dayOfWeek; // grouping by years
            });
        $nDays = [];
        $sDays = [];
        $newVisit = [];
        $usersVisit = [];
        foreach ($visits as $dayOfWeek){
            $newVisit[] = $dayOfWeek
                ->filter(function ($item) {
                    return $item->user_id == null;
                })->values()
                ->count();

            $usersVisit[] = $dayOfWeek
                ->filter(function ($item) {
                    return $item->user_id;
                })->values()
                ->count();
            foreach ($dayOfWeek as $v){
                $nDays[] = $v->updated_at->dayOfWeek;
            }
            $sDays[] = $weekMap[$v->updated_at->dayOfWeek];

        }
        $maxVisit = (max($newVisit) > max($usersVisit))? max($newVisit):max($usersVisit);


        return view('dash.dashboard',compact('maxVisit','newVisit','usersVisit','sDays'));
    }

    public function login(){
        if (Auth::check()) return redirect('/');
        return view('dash.user-pages.login');
        // return view('admin.pages.user-pages.login');
    }

    public function lfm(){
        return view('dash.user-pages.lfm');
        // return view('admin.pages.user-pages.login');
    }
}
