<?php

namespace App\Http\Controllers\Quote\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class QuoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'mobile_number' => 'required|string|max:20',
                    'additional_info' => 'nullable|string|max:1000',
                ];

            case 'PATCH':
                return [
                    'first_name' => 'sometimes|required|string|max:255',
                    'last_name' => 'sometimes|required|string|max:255',
                    'email' => 'sometimes|required|email|max:255',
                    'mobile_number' => 'sometimes|required|string|max:20',
                    'additional_info' => 'sometimes|nullable|string|max:1000',

                ];

            default:
                return [];
        }
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    "response" => false,
                    "message" => $validator->errors()->first(),
                    "data" => $validator->errors(),
                ],
                422
            )
        );
    }

    public function messages(){
        return [];
    }
}
