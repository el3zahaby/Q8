<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    public function handle($request, Closure $next, $guard = null)
    {
        $user = $request->user();
        if (isset($user) && $user->hasAnyRole(['super-admin', 'admin']) ) {
            return $next($request);
        }

        return redirect(route('admin.login'));
    }
}
