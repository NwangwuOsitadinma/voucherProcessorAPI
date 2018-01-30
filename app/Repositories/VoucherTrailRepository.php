<?php

namespace App\Repositories;

use App\Models\VoucherTrail;

class VoucherTrailRepository extends BaseRepository
{

    protected $model;

    public function __construct(VoucherTrail $voucherTrail)
    {
        $this->model = $voucherTrail;
    }

    public function getAllVoucherTrails()
    {
        return $this->model->with(['voucher.office_entity', 'voucher.user', 'response_by'])->get();
    }

    public function getById($id)
    {
        return $this->model->with(['voucher', 'response_by'])->find($id);
    }
}