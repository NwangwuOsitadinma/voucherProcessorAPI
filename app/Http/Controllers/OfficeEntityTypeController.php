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
        return $this->service->getOfficeEntities();
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
        $c = ['name' =>$request->name];
        if(!$this->service->create($c)){
            return response()->json([],503);
        }
        return response()->json(['message' => 'The Office Entity Type was created successfully', 'data' => c ],200);
    }


}