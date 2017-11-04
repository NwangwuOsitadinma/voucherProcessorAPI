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

class Branch extends Model
{
    protected $guarded = [];

    public function finance_head()
    {
        return $this->belongsTo(User::class);
    }
    public function payer()
    {
        return $this->belongsTo(User::class);
    }

    public function office_entities()
    {
        return $this->hasMany(OfficeEntity::class);
    }
}