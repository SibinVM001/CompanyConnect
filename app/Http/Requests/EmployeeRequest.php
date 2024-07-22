<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company' => 'required|exists:companies,id',
            'email' => 'required|email|unique:employees,email,' . ($this->route('employee')->id ?? ''),
            'phone' => [
                'required',
                'string',
                'max:10',
                'regex:/^\+?[0-9]{10}$/'
            ]
        ];
    }
}
