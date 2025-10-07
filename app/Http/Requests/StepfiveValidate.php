<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StepfiveValidate extends FormRequest
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
            'room_category'   => 'required|array', 
            'no_of_am' => 'nullable|array',
            'room_amenity' => 'nullable|array'
        ];
    }
    public function messages()
    {
        return [
            'room_category.required' => 'Please select at least one room category',
            'room_category.array'    => 'Room category must be an array',
            'no_of_am.array'        =>'Room amenity must be array',
            'room_amenity.array'        =>'Select room amenity number',
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
