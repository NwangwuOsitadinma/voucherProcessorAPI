<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 11/4/2017
 * Time: 5:47 PM
 */

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class BaseRepository
{
    protected $model;

    public function getAll(int $n, array $fields = null)
    {
        if ($fields != null){
           return $this->model->all($fields)->paginate($n);
        }
        return $this->model->paginate($n);
    }

    public function getById( $id){
        return $this->model->find($id);
    }

    public function update($id, array $fields){
        return $this->model->where('id',$id)->update($fields);
    }

    public function delete($id){
        return $this->model->delete($id);
    }

    public function create(array $object){
        return $this->model->create($object);
    }


}