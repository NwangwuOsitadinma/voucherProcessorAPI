<?php
/**
 * Created by PhpStorm.
 * User: Harrison
 * Date: 18/01/2018
 * Time: 09:53 AM
 */

namespace App\Repositories;


use App\Models\OfficeEntityUser;

class OfficeEntityUserRepository extends BaseRepository{

    public function __construct(OfficeEntityUser $officeEntityUser)
    {
        $this->model = $officeEntityUser;
    }
}