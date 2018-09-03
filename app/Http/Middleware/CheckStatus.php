<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\UsersModel as UsersModel;
use App\Http\Controllers\WebsiteController as Website;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::check())
        {
            return redirect('/login');
        }
        $user = \Auth::user();

        if(UsersModel::checkUserStatus($user->id))
        {
            return $next($request);
        }

        $name = Website::getRoleName(\Auth::user()->role_id);
        
        return redirect('/settings');
    }
}
