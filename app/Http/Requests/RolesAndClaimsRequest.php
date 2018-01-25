<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolesAndClaimsRequest extends FormRequest
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
            'role' => 'required',
            'claims' => 'required'
        ];
    }

    public function getAttributesArray()
    {
        return [
            'role' => $this->role,
            'claims' => $this->claims
        ];
    }
}
