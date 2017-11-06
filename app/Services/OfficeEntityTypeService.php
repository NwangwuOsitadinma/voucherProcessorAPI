<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 11/4/2017
 * Time: 8:40 PM
 */

namespace App\Services;


use App\Repositories\OfficeEntityTypeRepository;

class OfficeEntityTypeService
{
    protected $repository;
    public function __construct(OfficeEntityTypeRepository $repo){
        $this->repository = $repo;
    }

    public function getOfficeEntities($n){
        return $this->repository->getAll($n);
    }
    public function getEntity($id){
        if(!$this->repository->getById($id)){
            return null;
        }
        return $this->repository->getById($id);
    }
    public  function create($request){
        $data = ['name' => 'required'];
        $this->validate($request, $data);
        $c = ['name' =>$request->name];
        if(!$this->service->create($c)){
            return response()->json(['message' => 'something went wrong and the entity type could not be create'],503);
        }
        return response()->json(['message' => 'The Office Entity Type was created successfully', 'data' => $c ],200);
    }
    public function update($id, array $data){
        return $this->update($id, $data);
    }


}