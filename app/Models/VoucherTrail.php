<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class VoucherTrail extends Model
{
    protected $guarded = [];
    
    public function voucher() 
    {
        return $this->belongsTo(Voucher::class);
    }

    public function response_by()
    {
        return $this->belongsTo(User::class);
    }
}
