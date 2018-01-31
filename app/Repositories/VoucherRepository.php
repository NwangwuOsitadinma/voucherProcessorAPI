<?php
/**
 * Created by PhpStorm.
 * User: Harris
 * Date: 05/11/2017
 * Time: 05:26 AM
 */

namespace App\Repositories;


use App\Models\Voucher;

class VoucherRepository extends BaseRepository
{

    protected $model;

    public function __construct(Voucher $voucher)
    {
        $this->model = $voucher;
    }

    public function getById($id)
    {
        return $this->model->with(['user', 'office_entity', 'items'])->find($id);
    }

    public function search($text, int $n = null, $url = null, $userId = null)
    {
        if($userId) {
            $result = $this->model->where('user_id', $userId)
            ->where('voucher_number', 'like', '%' . $text . '%')
            ->orWhere('description', 'like', '%' . $text . '%')
            ->orWhere('reason', 'like', '%' . $text . '%')
            ->paginate($n);
            if($url != null) $result->withPath($url);
            return $result;
        }
        $result = $this->model->where('voucher_number', 'like', '%' . $text . '%')
            ->orWhere('description', 'like', '%' . $text . '%')
            ->orWhere('reason', 'like', '%' . $text . '%')
            ->paginate($n);
        if($url != null) $result->withPath($url);
        return $result;
    }

}