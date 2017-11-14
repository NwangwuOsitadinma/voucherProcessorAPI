<?php
/**
 * Created by PhpStorm.
 * User: Harris
 * Date: 05/11/2017
 * Time: 05:26 AM
 */

namespace App\Repositories;


use App\Models\Voucher;

class VoucherRepository extends BaseRepository{

    protected $model;

    public function __construct(Voucher $voucher){
        $this->model = $voucher;
    }

}