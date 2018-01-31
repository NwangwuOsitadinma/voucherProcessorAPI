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

    public function getAllVoucherTrails(int $n = null, $url = null)
    {
        $result = $this->model->with(['voucher.office_entity', 'voucher.user', 'response_by'])->orderBy('updated_at', 'desc')->paginate($n);
        if($url != null) $result->withPath($url);
        return $result;
    }

    public function getUserVoucherTrails($userId)
    {
        return $this->model->with(['voucher.office_entity', 'voucher.user', 'response_by'])
            ->whereHas('voucher.user', function ($query) use ($userId) {
                $query->where('id', '=', $userId);
            })
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function search($text, int $n = null, $url = null)
    {
        $result = $this->model->with(['voucher.office_entity', 'voucher.user', 'response_by'])
            ->whereHas('voucher', function ($query) use($text) {
                $query->where('voucher_number', 'like', '%' .$text .'%')
                    ->orWhere('description', 'like', '%' .$text .'%')
                    ->orWhere('status', 'like', '%' .$text .'%')
                    ->orWhere('reason', 'like', '%' .$text .'%');
            })
            ->orWhereHas('voucher.office_entity', function ($query) use ($text) {
                $query->where('name', 'like', '%' .$text .'%')
                    ->orWhere('description', 'like', '%' .$text .'%');
            })
            ->orWhereHas('voucher.user', function ($query) use ($text) {
                $query->where('full_name', 'like', '%' .$text .'%')
                    ->orWhere('email', 'like', '%' .$text .'%')
                    ->orWhere('employee_id', 'like', '%' .$text .'%');
            })
            ->orderBy('updated_at', 'desc')
            ->paginate($n);
        if($url != null) $result->withPath($url);
        return $result;
    }

    public function getById($id)
    {
        return $this->model->with(['voucher', 'response_by'])->find($id);
    }
}