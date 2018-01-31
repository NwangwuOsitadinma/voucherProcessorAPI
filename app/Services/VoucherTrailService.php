<?php
/**
 * Created by PhpStorm.
 * User: Harrison Favour
 * Date: 30/01/2018
 * Time: 08:05 AM
 */

namespace App\Services;


use Illuminate\Http\Request;
use App\Http\Requests\VoucherTrailRequest;
use App\Repositories\VoucherTrailRepository;

class VoucherTrailService
{

    protected $repository;

    public function __construct(VoucherTrailRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(int $n = null)
    {
        $voucherTrails = $this->repository->getAllVoucherTrails($n, '/api/voucher-trails?n=' .$n);
        return $voucherTrails
            ? $voucherTrails
            : response()->json(['message' => 'the resource you requested was not found']);
    }

    public function getById($id)
    {
        $voucherTrail = $this->repository->getById($id);
        return $voucherTrail
            ? $voucherTrail
            : response()->json(['message' => 'the resource you requested was not found']);
    }

    public function search($text, $n, $user)
    {
        if(!$user->isAn('ADMIN')){
            return;
        }
        $voucherTrails = $this->repository->search($text, $n, "/api/voucher-trails/find?q=". $text ."n=" .$n);
        return $voucherTrails
            ?: response()->json(['message' => 'the resource you requested was not found']);
    }

    public function create(array $voucherTrail)
    {
        if (!$this->repository->create($voucherTrail)) {
            return response()->json(['message' => 'the resource was not created', 'data' => $voucherTrail], 500);
        }
        return response()->json(['message' => 'the resource was successfully created', 'data' => $voucherTrail], 200);
    }

    public function update($id, array $voucherTrail)
    {
        if (!$this->repository->update($id, $voucherTrail)) {
            return response()->json(['message' => 'the resource was not updated', 'data' => $voucherTrail], 500);
        }
        return response()->json(['message' => 'the resource was successfully updated', 'data' => $voucherTrail], 200);
    }

    public function delete($id)
    {
        if (!$this->repository->delete($id)) {
            return response()->json(['message' => 'the resource was not deleted']);
        }
        return response()->json(['message' => 'the resource was successfully deleted']);
    }

}