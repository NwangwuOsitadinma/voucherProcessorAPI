<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 11/6/2017
 * Time: 4:11 PM
 */

namespace App\Services;


use App\Repositories\OfficeEntityRepository;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class OfficeEntityService
{
    protected $repository;

    public function __construct(OfficeEntityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getEntities($n)
    {
        if (!$this->repository->getAll($n)) {
            return response()->json(['message' => 'the resource you requested was not found']);
        }
        return $this->repository->getAll($n);
    }

    public function getEntity($id)
    {
        if (!$this->repository->getById($id)) {
            return response()->json(['message' => 'the resource you requested was not found']);
        }
        return $this->repository->getById($id);
    }

    public function createEntity(Request $request)
    {
        $c = ['name' => $request->name,
            'lead_id' => $request->lead,
            'branch_id' => $request->branch,
            'office_entity_type_id' => $request->office_entity_type,
        ];
        if (!$this->repository->create($c)) {
            return response()->json(['message' => 'the resource was not created', 'data' => $c], 500);
        }
        return response()->json(['message' => 'the resource was successfully created', 'data' => $c], 200);
    }
    public  function updateEntity($id, Request $request){
        $data = ['name' => $request->name,
            'lead_id' => $request->lead,
            'branch_id' => $request->branch,
            'office_entity_type_id' => $request->office_entity_type,
        ];
        if(!$this->repository->getById($id)){
            return response()->json(['message' => 'The resource you requested was not found']);
        }
        $this->repository->update($id, $data);
        return response()->json(['message' => 'The update was successful', $data]);
    }

    public function delete($id)
    {
        if (!$this->repository->delete($id)) {
            return response()->json(['message' => 'the resource was not deleted'], 404);
        }
        return response()->json(['message' => 'the resource was successfully deleted'], 200);
    }


}