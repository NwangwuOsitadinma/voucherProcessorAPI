<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherTrailRequest extends FormRequest
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
            'voucher' => 'required'
        ];
    }

    public function getAttributesArray()
    {
        return [
            'voucher_id' => $this->voucher,
            'response_by_id' => $this->user()->id
        ];
    }
}
