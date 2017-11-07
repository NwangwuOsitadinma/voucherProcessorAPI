<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 11/6/2017
 * Time: 4:05 PM
 */

namespace App\Http\Controllers;


use App\Services\OfficeEntityService;

class OfficeEntityController extends Controller
{
    protected $service;
    public function __construct(OfficeEntityService $entityService){
        $this->service = $entityService;
    }

    public function index(){
        return $this->service->getEntities(5);
    }
}