<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
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
            'full_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'employee_id' => 'required',
            'sex' => 'required'
        ];
    }

    public function getAttributesArray()
    {
        return [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'employee_id' => $this->employee_id,
            'sex' => $this->sex
        ];
    }
}