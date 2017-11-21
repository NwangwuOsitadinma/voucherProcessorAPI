<?php
/**
 * Created by PhpStorm.
 * User: Harrison Favour
 * Date: 15/11/2017
 * Time: 04:46 PM
 */

namespace App\Repositories;


use App\Models\Department;

class DepartmentRepository extends BaseRepository
{

    protected $model;

    public function __construct(Department $department)
    {
        $this->model = $department;
    }
}