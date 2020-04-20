<?php

namespace App\Http\Middleware;

use App\Visit;
use Closure;
use Illuminate\Support\Facades\Session;

class TrackUser
{
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        $visits = Visit::where([['ip_address', $request->ip()],['user_agent', $request->header('User-Agent')]])
            ->orWhere('user_id',$user->id ?? false)->first();

        if ($visits != null){
            if (isset($user) and $visits->user_id == null) $visits->user_id = $user->id;
            $visits->payload       = base64_encode($request->getContent());
            $visits->last_activity = time();
            $visits->save();
            return $next($request);
        }

        $visit = new Visit();
        if (isset($user)) {
            $visit->user_id   = $user->id;
        }
        $visit->ip_address    = $request->ip();
        $visit->user_agent    = $request->header('User-Agent');
        $visit->payload       = base64_encode($request->getContent());
        $visit->last_activity = time();


        $visit->save();
        return $next($request);
    }
}

