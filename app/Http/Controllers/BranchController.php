<?php
/**
 * Created by PhpStorm.
 * User: Harris
 * Date: 05/11/2017
 * Time: 05:11 AM
 */


namespace App\Http\Controllers;


use App\Models\Branch;
use App\Services\BranchService;
use Illuminate\Http\Request;

class BranchController extends Controller{

    protected $service;

    public function __construct(BranchService $branchService){
        $this->service = $branchService;
    }

    public function getAllBranches(){
        return $this->service->getAll(5);
    }

    public function getById($id){
        return $this->service->getById($id);
    }

    public function create(Request $request){
        $required = [
            'name' => 'required',
            'finance_head' => 'required',
            'payer' => 'required'
        ];
        $this->validate($request, $required);
        return $this->service->create($request);
    }

    public function update($id, Request $request){
        $required = [
            'name' => 'required',
            'finance_head' => 'required',
            'payer' => 'required'
        ];
        $this->validate($request, $required);
        return $this->service->update($id, $request);
    }

    public function delete($id){
        return $this->service->delete($id);
    }

}