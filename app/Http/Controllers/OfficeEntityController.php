<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 11/6/2017
 * Time: 4:05 PM
 */

namespace App\Http\Controllers;


class OfficeEntityController extends Controller
{
    protected $service;
    public function __construct($entityService){
        $this->service = $entityService;
    }
}