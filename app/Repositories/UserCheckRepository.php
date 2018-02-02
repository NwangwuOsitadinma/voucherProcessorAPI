<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 2/2/2018
 * Time: 9:36 AM
 */

namespace App\Repositories;


use App\Models\UserCheck;

class UserCheckRepository extends BaseRepository
{
    protected $model;

    public function __construct(UserCheck $m)
    {
        $this->model = $m;
    }
}