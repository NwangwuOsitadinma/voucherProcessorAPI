<?php

namespace App\Http\Middleware;

use App\Models\UserCheck;
use Closure;

class UserCheckMiddleware
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
        if(!UserCheck::where('email',$request->email)->first()){
            return response()->json(['message' => 'You do not have the authority to carry out this action. Contact the Admin']);
        }
        return $next($request);
    }
}
