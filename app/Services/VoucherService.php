<?php
/**
 * Created by PhpStorm.
 * User: Harris
 * Date: 05/11/2017
 * Time: 05:29 AM
 */


namespace App\Services;


use App\Mail\ApproveVoucherMail;
use App\Mail\CreateVoucherMail;
use App\Repositories\VoucherRepository;
use Illuminate\Http\Request;
use App\Http\Requests\VoucherRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class VoucherService
{
    protected $repository;
    protected $departmentService;

    public function __construct(VoucherRepository $voucherRepository, DepartmentService $departmentService, 
                ItemService $itemService, VoucherTrailService $voucherTrailService, UserService $userService, OfficeEntityService $officeEntityService)
    {
        $this->repository = $voucherRepository;
        $this->departmentService = $departmentService;
        $this->itemService = $itemService;
        $this->voucherTrailService = $voucherTrailService;
        $this->userService = $userService;
        $this->officeEntityService = $officeEntityService;
    }

    public function getAll(int $n = null, array $fields = null)
    {
        $vouchers = $this->repository->getAll($n, "/api/vouchers?n=" .$n, $fields);
        return $vouchers
            ?: response()->json(['message' => 'the resource you requested was not found']);
    }

    public function getById($id)
    {
        $voucher = $this->repository->getById($id);
        return $voucher
            ?: response()->json(['message' => 'the resource you requested was not found']);
    }

    public function search($text, $n, $user)
    {
        if(!$user->can('view-all-vouchers')){
            $vouchers = $this->repository->search($text, $n, "/api/vouchers/find?q=". $text ."n=" .$n, $user->id);
            return $vouchers
                ?: response()->json(['message' => 'the resource you requested was not found']);
        }
        $vouchers = $this->repository->search($text, $n, "/api/vouchers/find?q=". $text ."n=" .$n);
        return $vouchers
            ?: response()->json(['message' => 'the resource you requested was not found']);
    }


    public function create(VoucherRequest $request)
    {
        $voucher = $this->repository->create($request->getAttributesArray());
        if (!$voucher) {
            return response()->json(['message' => 'the voucher could not be created', 'type' => 'error', 'data' => $request->getAttributesArray()], 500);
        }
        foreach($request->items as $item) {
            $item['voucher_id'] = $voucher->id;
            $this->itemService->create($item);
        }
        $officeEntity = $this->officeEntityService->getEntity($request->office_entity_id);
        $supervisors = $this->userService->getCategorizedEmployees('supervisor');
        foreach ($supervisors as $supervisor) {
            try{
            Mail::to($supervisor->email)->queue(new CreateVoucherMail($request->getAttributesArray()['voucher_number'], $request->user()->email, $request->user()->full_name, $officeEntity->name .' - ' .$officeEntity->branch->name));
            } catch (\Exception $ex) {
                return response()->json(['message' => 'an error occurred while sending the emails for creating the voucher', 'type' => 'error', 'exception' => (string) $ex]);
            }
        }

        return response()->json(['message' => 'the voucher was successfully created', 'type' => 'success', 'data' => $request->getAttributesArray()], 200);
    }

    public function update($id, VoucherRequest $request)
    {
        $voucherId = $this->repository->update($id, $request->getAttributesArray());
        if (!$voucherId) {
            return response()->json(['message' => 'the voucher was not updated', 'data' => $request->getAttributesArray()], 500);
        }
        $this->itemService->deleteByParam('voucher_id', $id);
        foreach($request->items as $item) {
            $item['voucher_id'] = $id;
            $this->itemService->create($item);
        }
        return response()->json(['message' => 'the voucher was successfully updated', 'data' => $request->getAttributesArray()], 200);
    }

    public function delete($id)
    {
        if (!$this->repository->delete($id)) {
            return response()->json(['message' => 'the resource was not deleted']);
        }
        return response()->json(['message' => 'the resource was successfully deleted']);
    }


    public function approveVoucher($voucherId, $user, $voucherStatus = 'Waiting')
    {
        $voucher = [
            'status' => $voucherStatus
        ];
        $voucher = $this->repository->update($voucherId, $voucher);
        if (!$voucher) {
            return response()->json(['message' => 'the resource was not updated', 'data' => $voucher], 500);
        }
        $voucherTrail = [
            'voucher_id' => $voucherId,
            'response_by_id' => $user->id,
            'response' => $voucherStatus
        ];
        $this->voucherTrailService->create($voucherTrail);
        $voucher = $this->getById($voucherId);
        Mail::to($voucher->user->email)->queue(new ApproveVoucherMail($voucher->voucher_number, $voucher->user->full_name, $voucherStatus, $user->full_name));
        return response()->json(['message' => 'the resource was successfully updated', 'data' => $voucher], 200);
    }

    public function hasPaidVoucher($voucherId)
    {
        $voucher = [
            'paid' => true
        ];
        if (!$this->repository->update($voucherId, $voucher)) {
            return response()->json(['message' => 'the resource was not updated', 'data' => $voucher], 500);
        }
        return response()->json(['message' => 'the resource was successfully updated', 'data' => $voucher], 200);
    }

    public function getPayableVouchers()
    {
        $vouchers = $this->repository->getByParam('status', 'Accepted');
        return $vouchers
            ? $vouchers
            : response()->json(['message' => 'there are currently no payable vouchers']);
    }

    public function getUserVouchers($userId)
    {
        $usersVouchers = $this->repository->getByParam('user_id', $userId);
        return $usersVouchers
            ? $usersVouchers
            : response()->json(['message' => 'the resource you requested was not found']);
    }

    public function getOfficeEntityVouchers($officeEntityId)
    {
        $officeEntityVouchers = $this->repository->getByParam('office_entity_id', $officeEntityId);
        return $officeEntityVouchers
            ? $officeEntityVouchers
            : response()->json(['message' => 'the resource you requested was not found']);
    }
}