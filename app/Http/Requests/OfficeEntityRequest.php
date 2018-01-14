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

    public function getAttributesArray()
    {
        return [
            'name' => $this->name,
            'lead_id' => $this->lead,
            'branch_id' => $this->branch,
            'office_entity_type_id' => $this->office_entity_type,
        ];
    }
}
