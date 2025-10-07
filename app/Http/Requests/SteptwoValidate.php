<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class SteptwoValidate extends FormRequest
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
            'personal_email' =>'required|email|regex:/(.+)@(.+)\.(.+)/i',
            'profile_img' => 'mimes:jpeg,png,jpg|required',
            'name_of_host' =>'required|string|max:70',
            'language_speak'=>'required|string',
            'hosting_since'=>'required',
            'total_num_properties' =>'required|integer',
            'personal_description' =>'required',
            'personal_mobile_no' =>"required|integer|min:10",
            'personal_whatsapp_no' =>"nullable|integer|min:10",
        ];
    }
    /* Messages */
    public function messages() {
          return [
                'email.required' =>"Please enter email id",
                'email.regex' =>'Invalid email',
                'language_speak.required' =>'Language is required',
                'hosting_since.required' =>'Hosting since is required',
                'total_num_properties.required' =>'Total property is required',
                'total_num_properties.integer' =>'Only numbers are allowed',
                'personal_description.required' =>'Description is required',
                'personal_mobile_no.required' =>'Mobile no is required',
                'personal_mobile_no.max' =>'Mobile no maximum no 12',
                'personal_mobile_no.integer' =>'Mobile no is should be integer',
                'personal_whatsapp_no.max' =>'Whatsapp no should be max 12',
                'personal_whatsapp_no.integer' =>'Whatsapp no is should be integer',
                'profile_img.required'  =>'Profile image is required',
                'profile_img.mimes'  =>'Only jpeg,png,jpg formats are allowed',
          ];
    }
    /* Custom error message */
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
