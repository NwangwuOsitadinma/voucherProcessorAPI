<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 11/4/2017
 * Time: 8:17 PM
 */

namespace App\Repository;


use App\Models\OfficeEntityType;

class OfficeEntityTypeRepository
{
    protected $model;

    public function __construct(OfficeEntityType $entityType)
    {
        $this->model = $entityType;
    }
}