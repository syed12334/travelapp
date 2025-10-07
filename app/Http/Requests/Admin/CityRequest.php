<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CityRequest extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'   => 'required|string|min:3',
            'state' =>'required'
        ];
    }
     public function messages()
    {
        return [
            'name.required' => 'Please enter a state',
            'name.string'    => 'Only string value is allowed',
            'name.min'  => 'State must be minimum 3 characters',
            'state.required' =>'State is required'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
         throw new HttpResponseException(
        response()->json([
            'status'  => 422,
            'errors'  => $validator->errors()
        ], 422)
    );
    }
}
