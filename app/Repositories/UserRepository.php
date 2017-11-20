<?php
/**
 * Created by PhpStorm.
 * User: Harrison Favour
 * Date: 17/11/2017
 * Time: 03:49 PM
 */

namespace App\Repositories;


use App\User;

class UserRepository extends BaseRepository{

    protected $model;

    public function __construct(User $user){
        $this->model = $user;
    }
}