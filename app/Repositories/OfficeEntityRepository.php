<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 11/6/2017
 * Time: 4:07 PM
 */

namespace App\Repositories;


use App\Models\OfficeEntity;

class OfficeEntityRepository extends BaseRepository
{
    protected $model;

    public function __construct(OfficeEntity $model)
    {
        $this->model = $model;
    }

    public function getAll(int $n = null, $url = null, array $fields = null)
    {
        if ($fields && $n) {
            $result = $this->model->with(['branch'])->orderBy('updated_at', 'desc')->get($fields)->paginate($n);
            if($url != null) $result->withPath($url);
            return $result;
        } elseif (!$fields && $n) {
            $result = $this->model->with(['branch'])->orderBy('updated_at', 'desc')->paginate($n);
            if($url != null) $result->withPath($url);
            return $result;
        } elseif($fields && !$n) {
            return $this->model->with(['branch'])->orderBy('updated_at', 'desc')->get($fields);
        } else {
            return $this->model->with(['branch'])->orderBy('updated_at', 'desc')->get();
        }
    }

    public function getById($id) {
        return $this->model->with(['lead', 'branch', 'office_entity_type', 'office_entity_users.user'])->find($id);
    }

    public function search($text, int $n = null, $url = null)
    {
        $result = $this->model->where('name', 'like', '%' . $text . '%')
            ->orWhere('description', 'like', '%' . $text . '%')
            ->paginate($n);
        if($url != null) $result->withPath($url);
        return $result;
    }

}