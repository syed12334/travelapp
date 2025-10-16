<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class StepsixValidate extends FormRequest
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
            'check_in'              => 'required|string', 
            'check_out'             => 'required|string', 
            'cancel_prepay'         => 'required|string',
            'children_beds'         => 'required|string',
            'no_age_restrict'       => 'required|string',
            'pets'                  =>'required|string',
            'groups'                =>'required|string',
            'accept_payment_method' =>'required|string',
            'parties'               =>'required|string'
        ];
    }
    public function messages()
    {
        return [
            'check_in.required'                 =>'Please enter checkin',
            'check_out.required'                =>'Please enter checkout',
            'cancel_prepay.required'            =>'Please enter cancel or prepayment',
            'children_beds.required'            =>'Please enter children beds',
            'no_age_restrict.required'          =>'Please enter no of age restriction',
            'pets.required'                     =>'Please enter pets',
            'groups.required'                   =>'Please enter groups',
            'accept_payment_method.required'    =>'Please enter accept payment method',
            'parties.required'                  =>'Please enter parties',
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
