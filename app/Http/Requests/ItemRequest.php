<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class ItemRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required',
            'voucher_id' => 'required'
        ];
    }

    public function getAttributesArray()
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'voucher_id' => $this->voucher_id
        ];
    }
}
