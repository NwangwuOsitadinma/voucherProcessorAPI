<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 11/4/2017
 * Time: 3:44 PM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class OfficeEntity extends Model
{
    protected $guarded = [];

    public function lead()
    {
        return $this->belongsTo(User::class, 'lead_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function office_entity_type()
    {
        return $this->belongsTo(OfficeEntityType::class);
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}