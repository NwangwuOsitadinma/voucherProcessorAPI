<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class OfficeEntityRequest extends FormRequest
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
            'lead' => 'required',
            'branch' => 'required',
            'office_entity_type' => 'required'
        ];
    }
}
