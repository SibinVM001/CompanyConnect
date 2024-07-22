<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email,' . ($this->route('company')->id ?? ''),
            'logo' => 'image|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url'
        ];
    }
    
    /**
     * Validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'email.required' => 'The email field is required.',
            'email.unique' => 'The email has already been taken.',
            'email.string' => 'The email must be a string.',
            'email.email' => 'The email must be a valid email address.',
            'logo.image' => 'The logo must be an image file.',
            'logo.dimensions' => 'The logo dimensions must be 100x100 pixels.',
            'website.url' => 'The website format is invalid.',
        ];
    }
}
