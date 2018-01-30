<?php
/**
 * Created by PhpStorm.
 * User: Harrison
 * Date: 25/01/2018
 * Time: 10:18 AM
 */

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RoleRepository {


    public function getAll()
    {
        return DB::select('select id, name from roles');
    }

}