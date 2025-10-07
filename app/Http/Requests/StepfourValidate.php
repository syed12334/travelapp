<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StepfourValidate extends FormRequest
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
            'property_amenity'   => 'required|array', 
            'no_of_am' => 'nullable|array'
        ];
    }
    public function messages()
    {
        return [
            'property_amenity.required' => 'Please select at least one amenity',
            'property_amenity.array'    => 'Amenity input must be an array'
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
