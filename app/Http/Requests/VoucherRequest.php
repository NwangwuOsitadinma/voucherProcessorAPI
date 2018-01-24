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
            'description' => 'required',
            'reason' => 'required',
            'office_entity_id' => 'required',
            'items' => 'required'
        ];
    }

    public function getAttributesArray()
    {
        return [
            'voucher_number' => mt_rand(),
            'description' => $this->description,
            'reason' => $this->reason,
            'office_entity_id' => $this->office_entity_id,
            // 'user_id' => $this->user()->id ?? 1
            'user_id' => 1
        ];
    }
}
