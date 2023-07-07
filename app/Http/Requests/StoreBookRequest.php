<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'title' => [
                'required',
                'max:50',
            ],
            'subtitle' => [
                'max:50',
            ],
            'year_published' => [
                'digits:4',
                'integer',
            ],
            'edition' => [
                'integer',
                'max:10',
            ],
            'isbn_10'=> [
                'max:10',
            ],
            'isbn_13'=> [
                'max:13',
            ],
            'genre'=> [
                'max:32',
            ],
            'sub_genre'=> [
                'max:32',
            ],
            'height' => [
                'digits:3',
                'integer',
            ],
        ];
    }
}
