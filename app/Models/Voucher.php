<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 11/4/2017
 * Time: 3:36 PM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $guarded = [];

    public function office_entity_type()
    {
        return $this->belongsTo(OfficeEntityType::class);
    }

    public function office_entity()
    {
        return $this->belongsTo(OfficeEntity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }


}