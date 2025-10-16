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
            'room_img'   => 'required|array|min:1', 
            'room_img.*' => 'mimes:jpeg,png,jpg|max:1000',
            'no_of_am' => 'nullable|array',
            'room_amenity' => 'nullable|array',
            'no_of_rooms' =>'required|array',
            'price'         =>'required|array',
            'price.*' => 'required',
            'tax'           =>'required|array',
            'tax.*' => 'required',
            'discount'      =>'required|array',
            'discount.*' => 'required|numeric',
            'rate_inclusion' =>'required'
        ];
    }
    public function messages()
    {
        return [
            'room_category.required'    =>'Please select at least one room category',
            'room_category.array'       =>'Room category must be an array',
            'no_of_am.array'            =>'Room amenity must be array',
            'room_amenity.array'        =>'Select room amenity number',
            'no_of_rooms.required'      =>'Please enter no of rooms',
            'no_of_rooms.array'         =>'Rooms should be in array format',
            'room_img.required'         =>'Please select at least one room image',
            'room_img.array'            => 'Room image input must be an array',
            'price.required'            =>'Price is required',
            'price.array'               =>'Price should be in array format',
            'price.integer'             =>'Price should be in numeric value',
            'tax.required'              =>'Tax is required',
            'tax.array'                 =>'Tax should be in array format',
            'tax.integer'               =>'Tax should be in numeric value',
            'discount.required'         =>'Discount is required',
            'discount.array'            =>'Discount should be in array format',
            'discount.integer'          =>'Discount should be in numeric value',
            'rate_inclusion.required'   =>'Rate inclusion is required',
            'rate_inclusion.string'     =>'Rate inclusion should be string',
            'price.*.required'          =>'Price is required',
            'tax.*.required'            =>'Tax is required',
            'discount.*.required'       =>'Discount is required',
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
