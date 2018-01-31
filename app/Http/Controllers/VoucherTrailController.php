<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VoucherTrailService;

class VoucherTrailController extends Controller
{
    private $service;

    public function __construct(VoucherTrailService $voucherTrailService)
    {
        $this->service = $voucherTrailService;
    }

    public function getAllVoucherTrails(Request $request)
    {
        return $this->service->getAll($request->n);
    }

    public function search(Request $request)
    {
        return $this->service->search($request->q, $request->n, $request->user());
    }

    // public function getVoucherTrailDetails()
    // {
    //     return $this->service->getById($id);
    // }
}
