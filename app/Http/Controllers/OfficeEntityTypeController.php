<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 11/4/2017
 * Time: 8:31 PM
 */

namespace App\Http\Controllers;



use App\Services\OfficeEntityTypeService;

class OfficeEntityTypeController extends Controller
{
    protected $service;
    public function __construct(OfficeEntityTypeService $service)
    {
        $this->service = $service;
    }
    public function index(){
        return $this->service->getOfficeEntities();
    }
    public function show($id){
        if($this->service->getEntity($id) == null){
            return response()->json(['status' => 400, 'message' => 'The resource you requested does not exist']);
        }
        return response()->json($this->service->getEntity($id));
    }


}