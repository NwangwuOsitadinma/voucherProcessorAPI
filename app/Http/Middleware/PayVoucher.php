<?php

namespace App\Http\Middleware;

use Closure;

class PayVoucher
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
        if($user && $user->can('pay-voucher')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'You do not have the authority to carry out this action. Contact the Admin']);
        }
    }
}
