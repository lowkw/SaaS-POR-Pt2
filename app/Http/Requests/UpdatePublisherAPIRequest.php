<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdatePublisherAPIRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>[
                'required',
                'max:128',
            ],
            'city'=> [
                'max:128',
            ],
            'country_code'=> [
                'max:3',
            ],
            //
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => __('Validation errors'),
                'data' => $validator->errors(),
            ])
        );
    }


    public function messages()
    {
        return [
            'name' => __('Name is required and must not exceed 128 characters.'),
            'city' => __('City must not exceed 128 characters.'),
            'country_code' => __('Country code must not exceed 3 characters.'),
        ];
    }
}
