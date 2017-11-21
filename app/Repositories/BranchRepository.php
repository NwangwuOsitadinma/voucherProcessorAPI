<?php
/**
 * Created by PhpStorm.
 * User: Harris
 * Date: 05/11/2017
 * Time: 05:07 AM
 */

namespace App\Repositories;


use App\Models\Branch;

class BranchRepository extends BaseRepository
{

    protected $model;

    public function __construct(Branch $branch)
    {
        $this->model = $branch;
    }

}