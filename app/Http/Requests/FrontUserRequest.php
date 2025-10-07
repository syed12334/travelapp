<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class FrontUserRequest extends FormRequest
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
            'name'  => 'required|string|max:70',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' =>'required',
            'gender' =>'integer'
        ];
    }
    public function messages() {
        return [
            'name.required' =>'Name is required',
            'name.string'   =>'Only string is allowed',
            'name.max'      =>'Max 70 characters are allowed',
            'email.required'    =>'Email is required',
            'email.regex'       =>'Please enter valid email id',
            'email.email'       =>'Please enter valid email id',
            'password.required' =>'Password is required',
            'password_confirmation.required' =>'Confirm password is required',
            'gender.integer'    =>'only integer are allowed'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        return  response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
    }
}
