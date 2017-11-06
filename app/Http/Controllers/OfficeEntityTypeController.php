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
        return $this->service->getOfficeEntities(5);
    }
    public function show($id){
        if($this->service->getEntity($id) == null){
            return response()->json(['message' => 'The resource you requested does not exist'],404);
        }
        return response()->json($this->service->getEntity($id),200);
    }
    public function create(Request $request){
        $data = ['name' => 'required'];
        $this->validate($request, $data);
        return $this->service->create($request);
    }




}