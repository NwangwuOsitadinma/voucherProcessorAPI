<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 11/6/2017
 * Time: 4:05 PM
 */

namespace App\Http\Controllers;


use App\Services\OfficeEntityService;
use Illuminate\Http\Request;
use App\Http\Requests\OfficeEntityRequest;

class OfficeEntityController extends Controller
{
    protected $service;

    public function __construct(OfficeEntityService $entityService)
    {
        $this->service = $entityService;
    }

    public function getAllEntities(Request $request)
    {
        $n = $request->input('n') ?? null;
        $fields = $request->input('fields') ? explode(',', $request->input('fields')) : null;
        return $this->service->getEntities($n, $fields);
    }

    public function show($id)
    {
        return $this->service->getEntity($id);
    }

    public function create(OfficeEntityRequest $request)
    {
        return $this->service->createEntity($request);
    }
    public function update($id, OfficeEntityRequest $request)
    {
        return $this->service->updateEntity($id, $request);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }

}