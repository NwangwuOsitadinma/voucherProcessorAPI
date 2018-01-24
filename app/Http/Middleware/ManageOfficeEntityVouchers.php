<?php

namespace App\Http\Middleware;

use Closure;

class ManageOfficeEntityVouchers
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
        if($user && $user->can('manage-office-entity-vouchers')) {
            return $next($request);
        } else {
            return redirect()->back()->intended('/');
        }
    }
}
