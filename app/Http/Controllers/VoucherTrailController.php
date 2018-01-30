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

    public function getAllVoucherTrails()
    {
        return $this->service->getAll();
    }

    // public function getVoucherTrailDetails()
    // {
    //     return $this->service->getById($id);
    // }
}
