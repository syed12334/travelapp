<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class SteponeValidate extends FormRequest
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
          'email' =>'required|email|regex:/(.+)@(.+)\.(.+)/i',
            'property_name' =>'required|string|max:70',
            'booking_start_year'=>'required',
            'property_built_date'=>'required',
            'property_hosted' =>'required',
            'host_stay_property' =>'required',
            'mobile_no' =>"required|integer|min:10",
            'whatsapp_no' =>"required|integer|min:10",
            'landline_no' =>"integer|min:8"
        ];
    }
    /* Messages */
    public function messages() {
          return [
                'email.required' =>"Please enter email id",
                'email.regex' =>'Invalid email',
                'booking_start_year.required' =>'Booking start date is required',
                'property_built_date.required' =>'Property built date is required',
                'property_hosted.required' =>'Host stay property is required',
                'host_stay_property.required' =>'Property name is required',
                'mobile_no.required' =>'Mobile no is required',
                'mobile_no.max' =>'Mobile no maximum no 12',
                'mobile_no.integer' =>'Mobile no is should be integer',
                'landline_no.integer' =>'Landline no is should be integer',
                'landline_no.max' =>'Landline no maximum no 8',
                'whatsapp_no.max' =>'Whatsapp no should be max 12',
                'whatsapp_no.integer' =>'Whatsapp no is should be integer'
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
