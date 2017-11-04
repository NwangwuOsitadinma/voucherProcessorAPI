<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 11/4/2017
 * Time: 3:43 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OfficeEntityType extends Model
{
    protected $guarded = [];

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }

    public function office_entities()
    {
        return $this->hasMany(OfficeEntity::class);
    }

}