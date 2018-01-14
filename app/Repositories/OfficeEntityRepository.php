<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 11/6/2017
 * Time: 4:07 PM
 */

namespace App\Repositories;


use App\Models\OfficeEntity;

class OfficeEntityRepository extends BaseRepository
{
    protected $model;

    public function __construct(OfficeEntity $model)
    {
        $this->model = $model;
    }

    public function getById($id) {
        return $this->model->with(['lead', 'branch', 'office_entity_type'])->find($id);
    }


}