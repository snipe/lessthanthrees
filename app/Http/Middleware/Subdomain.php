<?php

namespace App\Http\Middleware;
use Closure;
use App\User;

class Subdomain
{
    public function handle($request, Closure $next, $guard = null)
    {
        $selected_account = User::where('username','=',$request->subdomain)->first();
        if ($selected_account) {
            $request->selected_account = $selected_account;
            view()->share('selected_account',$selected_account);
            return $next($request);
        }
        return redirect()->route('home');

    }


}
