<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'country_name' => 'required|unique:country,country_name|regex:/^[a-zA-Z &]+$/|max:255|min:4',
        ];
    }

    public function messages()
    {
        return [
            'country_name.required' => 'The country name field is missing.',
            'country_name.regex' => 'Invalid format for the country name.',
            'country_name.unique' => 'The country name must be unique.',
            'country_name.min' => 'The country name must be at least 4 characters.',
            'country_name.max' => 'The country name cannot exceed 255 characters.',
        ];
    }
}
