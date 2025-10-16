<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class StepsevenValidate extends FormRequest
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
            'restaurant_info'              => 'required', 
            'near_by_location'             => 'required', 
            'question'                     => 'required|array',
            'question.*'                     => 'required',
            'answer'                       => 'required|array',
            'answer.*'                       => 'required'
        ];
    }
    public function messages()
    {
        return [
            'restaurant_info.required'          =>'Please enter restaurant info',
            'near_by_location.required'         =>'Please enter near by locations',
            'question.required'                 =>'Please enter question',
            'question.array'                    =>'Question should be in array format',
            'answer.required'                   =>'Please enter answer',
            'answer.array'                      =>'Answer should be in array format',
            'question.*.required'               =>'Question is required',
            'answer.*.required'                 =>'Answer is required'
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
