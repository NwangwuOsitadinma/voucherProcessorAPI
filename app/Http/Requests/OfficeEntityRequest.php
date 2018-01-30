<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'lead_id' => 'required',
            'branch_id' => 'required',
            'description' => 'required',
            'office_entity_type_id' => 'required',
            'employees' => 'required'
        ];
    }

    public function getAttributesArray()
    {
        return [
            'name' => $this->name,
            'lead_id' => $this->lead_id,
            'branch_id' => $this->branch_id,
            'description' => $this->description,
            'office_entity_type_id' => $this->office_entity_type_id,
        ];
    }
}
