<?php
/**
 * Created by PhpStorm.
 * User: Harris
 * Date: 05/11/2017
 * Time: 05:32 AM
 */

namespace App\Http\Controllers;


use App\Models\Voucher;
use App\Services\VoucherService;
use Illuminate\Http\Request;

class VoucherController extends Controller{

    protected $service;

    public function __construct(VoucherService $voucherService){
        $this->service = $voucherService;
    }

    public function getAllVouchers(){
        return $this->service->getAll(5);
    }

    public function getById($id){
        return $this->service->getById($id);
    }

    public function create(Request $request){
        $required = [
            'voucher_number' => 'required',
            'description' => 'required',
            'office_entity_type' => 'required',
            'office_entity' => 'required'
        ];
        $this->validate($request, $required);
        return $this->service->create($request);
    }

    public function update($id, Request $request){
        $required = [
            'voucher_number' => 'required',
            'description' => 'required',
            'office_entity_type' => 'required',
            'office_entity' => 'required'
        ];
        $this->validate($request, $required);
        return $this->service->update($id, $request);
    }

    public function delete($id){
        return $this->service->delete($id);
    }

}