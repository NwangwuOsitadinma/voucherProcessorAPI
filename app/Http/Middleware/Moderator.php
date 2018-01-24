<?php

namespace App\Http\Middleware;

use Closure;

class Moderator
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
        $user = $request->user();
        if($user && ($user->isA('MODERATOR') || $user->isAn('ADMIN'))){
            return $next($request);
        }
        return redirect()->back()->intended('/');
    }
}
