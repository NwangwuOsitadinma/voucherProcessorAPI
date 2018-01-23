<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'voucher_number' => 'required',
            'description' => 'required',
            'reason' => 'required',
            'office_entity_id' => 'required',
            'items' => 'required'
        ];
    }

    public function getAttributesArray()
    {
        return [
            'voucher_number' => $this->voucher_number,
            'description' => $this->description,
            'reason' => $this->reason,
            'office_entity_id' => $this->office_entity_id,
            // 'user_id' => $this->user()->id ?? 1
            'user_id' => 1
        ];
    }
}
