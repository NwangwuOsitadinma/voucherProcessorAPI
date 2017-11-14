<?php
/**
 * Created by PhpStorm.
 * User: Harris
 * Date: 05/11/2017
 * Time: 03:48 AM
 */

namespace App\Http\Controllers;


use App\Models\Item;
use App\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller{

    private $service;

    public function __construct(ItemService $itemService){
        $this->service = $itemService;
    }

    public function getAllItems(){
        return $this->service->getAll(5);
    }

    public function getById($id){
        return $this->service->getById($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request){
        $required = [
            'name' => 'required',
            'price' => 'required',
            'voucher' => 'required'
        ];
        $this->validate($request, $required);
        return $this->service->create($request);
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function update($id, Request $request){
        $required = [
            'name' => 'required',
            'price' => 'required',
            'voucher' => 'required'
        ];
        $this->validate($request, $required);
        return $this->service->update($id, $request);
    }

    public function delete($id){
        return $this->service->delete($id);
    }

}