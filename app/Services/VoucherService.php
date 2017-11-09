<?php
/**
 * Created by PhpStorm.
 * User: Harris
 * Date: 05/11/2017
 * Time: 05:29 AM
 */


namespace App\Services;


use App\Repositories\VoucherRepository;
use Illuminate\Http\Request;

class VoucherService {
    private $repository;

    public function __construct(VoucherRepository $voucherRepository){
        $this->repository = $voucherRepository;
    }

    public function getAll($n){
        if(!$this->repository->getAll($n)){
            return response()->json(['message' => 'the resource you requested was not found']);
        }
        return $this->repository->getAll($n);
    }

    public function getById($id){
        if(!$this->repository->getById($id)){
            return response()->json(['message' => 'the resource you requested was not found']);
        }
        return $this->repository->getById($id);
    }

    public function create(Request $request){
        $voucher = ['voucher_number' => $request->voucher_number,
            'description' => $request->description,
            'office_entity_type_id' => $request->office_entity_type,
            'office_entity_id' => $request->office_entity
        ];
        if(!$this->repository->create($voucher)){
            return response()->json(['message' => 'the resource was not created', 'data' => $voucher], 500);
        }
        return response()->json(['message' => 'the resource was successfully created', 'data' => $voucher], 200);
    }

    public function update($id, Request $request){
        $voucher = ['voucher_number' => $request->voucher_number,
            'description' => $request->description,
            'office_entity_type_id' => $request->office_entity_type,
            'office_entity_id' => $request->office_entity
        ];
        if(!$this->repository->update($id, $voucher)){
            return response()->json(['message' => 'the resource was not updated', 'data' => $voucher], 500);
        }
        return response()->json(['message' => 'the resource was successfully updated', 'data' => $voucher], 200);
    }

    public function delete($id){
        if(!$this->repository->delete($id)) {
            return response()->json(['message' => 'the resource was not deleted']);
        }
        return response()->json(['message' => 'the resource was successfully deleted']);
    }

}