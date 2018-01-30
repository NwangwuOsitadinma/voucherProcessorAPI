<?php

/**
 * Author: Harrison Grant
 * created on 05/11/2017
 **/

namespace App\Repositories;

use App\Models\Item;

class ItemRepository extends BaseRepository
{
    protected $model;

    public function __construct(Item $item)
    {
        $this->model = $item;
    }

    public function getById($id)
    {
        return $this->model->with(['voucher'])->find($id);
    }
}

