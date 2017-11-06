<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 11/6/2017
 * Time: 4:11 PM
 */

namespace App\Services;


use App\Repositories\OfficeEntityRepository;

class OfficeEntityService
{
    protected $repository;

    public function __construct(OfficeEntityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(){

    }
}