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
            return response()->json(['message' => 'You do not have the authority to carry out this action. Contact the Admin']);
        }
        return $next($request);
    }
}
