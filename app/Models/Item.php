<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 11/4/2017
 * Time: 3:45 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}