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

    public function getOfficeEntities(){
        return $this->repository->getAll();
    }
    public function getEntity($id){
        if(!$this->repository->getById($id)){
            return null;
        }
        return $this->repository->getById($id);
    }
    public  function create($data){
        return $this->repository->create($data);
    }

}