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

class VoucherController extends Controller
{

    private $service;

    public function __construct(VoucherService $voucherService)
    {
        $this->service = $voucherService;
    }

    public function getAllVouchers()
    {
        return $this->service->getAll(5);
    }

    public function getById($id)
    {
        return $this->service->getById($id);
    }

    public function create(Request $request)
    {
        $required = [
            'voucher_number' => 'required',
            'description' => 'required',
            'office_entity_type' => 'required',
            'office_entity' => 'required'
        ];
        $this->validate($request, $required);
        return $this->service->create($request);
    }

    public function update($id, Request $request)
    {
        $required = [
            'voucher_number' => 'required',
            'description' => 'required',
            'office_entity_type' => 'required',
            'office_entity' => 'required'
        ];
        $this->validate($request, $required);
        return $this->service->update($id, $request);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
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

    public function approveVoucher($voucherId)
    {
        return $this->service->approveVoucher($voucherId);
    }

    public function hasPaidVoucher($voucherId)
    {
        return $this->service->hasPaidVoucher($voucherId);
    }

}