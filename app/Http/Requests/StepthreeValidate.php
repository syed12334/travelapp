<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class StepthreeValidate extends FormRequest
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
            'photos'   => 'required|array|min:1', 
            'photos.*' => 'mimes:jpeg,png,jpg,mp4|max:102400',
            'youtube_link' => 'nullable|array'
        ];
    }
    public function messages()
    {
        return [
            'photos.required' => 'Please select at least one photo',
            'photos.array'    => 'Photos input must be an array',
            'photos.*.mimes'  => 'Only jpeg, png, jpg, mp4 are allowed',
            'photos.*.max'    => 'File size must not exceed 100MB',
            'youtube_link.url' => 'Enter valid URL',
            'youtube_link.array' => 'Youtube link input must be an array',
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
