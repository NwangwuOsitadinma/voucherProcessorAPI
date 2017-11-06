<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 11/4/2017
 * Time: 8:31 PM
 */

namespace App\Http\Controllers;



use App\Services\OfficeEntityTypeService;
use Illuminate\Http\Request;

class OfficeEntityTypeController extends Controller
{
    protected $service;
    public function __construct(OfficeEntityTypeService $service)
    {
        $this->service = $service;
    }
    public function index(){
        return $this->service->getEntityTypes(5);
    }
    public function show($id){
        return $this->service->getEntityType($id);
    }
    public function create(Request $request){
        $data = ['name' => 'required'];
        $this->validate($request, $data);
        return $this->service->createEntityType($request);
    }
    public function update($id, Request $request){
        $data = ['name' => 'required'];
        $this->validate($request,$data);
        return $this->service->updateEntityType($id, $request);
    }
    public function delete($id){
        return $this->service->deleteEntityType($id);
    }




}