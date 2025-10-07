<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class RoomRequest extends FormRequest
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
            'room'   => 'required|string|min:3'
        ];
    }
     public function messages()
    {
        return [
            'room.required' => 'Please enter a amenity',
            'room.string'    => 'Only string value is allowed',
            'room.min'  => 'Amenity must be minimum 3 characters'
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
