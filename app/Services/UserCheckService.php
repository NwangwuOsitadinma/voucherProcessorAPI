<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 2/2/2018
 * Time: 9:38 AM
 */

namespace App\Services;


use App\Repositories\UserCheckRepository;

class UserCheckService extends BaseService
{
    protected $repository;

    public function __construct(UserCheckRepository $r)
    {
        $this->repository = $r;
    }
}