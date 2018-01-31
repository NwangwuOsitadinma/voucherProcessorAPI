<?php
/**
 * Created by PhpStorm.
 * User: Harris
 * Date: 05/11/2017
 * Time: 05:32 AM
 */

namespace App\Http\Controllers;


use App\Services\VoucherService;
use Illuminate\Http\Request;
use App\Http\Requests\VoucherRequest;

class VoucherController extends Controller
{

    protected $service;

    public function __construct(VoucherService $voucherService)
    {
        $this->service = $voucherService;
    }

    public function getAllVouchers(Request $request)
    {
        $n = $request->input('n') ?: null;
        $fields = $request->input('fields') ? explode(',', $request->input('fields')) : null;
        return $this->service->getAll($n, $fields);
    }

    public function getById($id)
    {
        return $this->service->getById($id);
    }

    public function create(VoucherRequest $request)
    {
        return $this->service->create($request);
    }

    public function update($id, VoucherRequest $request)
    {
        return $this->service->update($id, $request);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }

    public function searchText(Request $request)
    {
        return $this->service->search($request->q, $request->n, $request->user());
    }

    public function getUserVouchers(Request $request)
    {
        $userId = $request->user()->id;
        return $this->service->getUserVouchers($userId);
    }

    public function getOfficeEntityVouchers(Request $request)
    {
        $officeEntityId = $request->id;
        return $this->service->getOfficeEntityVouchers($officeEntityId);
    }

    public function getPayableVouchers()
    {
        return $this->service->getPayableVouchers();
    }

    public function approveVoucher($voucherId, Request $request)
    {
        return $this->service->approveVoucher($voucherId, $request->user()->id, $request->status);
    }

    public function hasPaidVoucher($voucherId)
    {
        return $this->service->hasPaidVoucher($voucherId);
    }

}