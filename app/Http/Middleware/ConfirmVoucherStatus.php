<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\VoucherRepository;

class ConfirmVoucherStatus
{
    private $repository;

    public function __construct(VoucherRepository $voucherRepository)
    {
        $this->repository = $voucherRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $voucher = $this->repository->getById($request->voucherId ?: $request->id);
        if($voucher->status !== 'Waiting'){
            return response()->json(['message' => 'unable to perform this transaction']);
        }
        return $next($request);
    }
}
