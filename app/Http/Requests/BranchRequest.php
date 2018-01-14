<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class BranchRequest extends FormRequest
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
            'location' => 'required',
            'description' => 'required',
            'finance_head' => 'required',
            'payer' => 'required'
        ];
    }

    public function getAttributesArray()
    {
        return [
            'name' => $this->name,
            'finance_head_id' => $this->finance_head,
            'payer_id' => $this->payer,
            'location' => $this->location,
            'description' => $this->description
        ];
    }
}
