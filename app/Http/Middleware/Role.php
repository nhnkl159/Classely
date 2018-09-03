<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!\Auth::check())
        {
            return redirect('login');
        }

        $user = \Auth::user();
        if($user->role_id == $role)
        {
            return $next($request);
        }

        return redirect('/');
    }
}
