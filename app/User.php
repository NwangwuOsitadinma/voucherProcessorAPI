<?php

namespace App;

use App\Models\OfficeEntity;
use App\Models\Supervisor;
use App\Models\Voucher;
use App\Models\OfficeEntityUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'employee_id', 'password', 'sex',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function setValues($fullName, $email, $employee_id, $sex, $id = null)
    {
        $this->id = $id;
        $this->full_name = $fullName;
        $this->email = $email;
        $this->employee_id = $employee_id;
        $this->sex = $sex;
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function office_entities()
    {
        return $this->hasMany(OfficeEntityUser::class)->with(['office_entity']);
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }
}
