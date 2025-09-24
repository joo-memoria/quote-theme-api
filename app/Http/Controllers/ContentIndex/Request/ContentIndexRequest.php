<?php

namespace App\Http\Controllers\ContentIndex\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ContentIndexRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'content' => 'sometimes|required|array',
            'version' => 'nullable|integer',
            'is_published' => 'nullable|boolean',
            'url' => 'sometimes|string|max:255|unique:content_index,url'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'response' => false,
                    'message' => $validator->errors()->first(),
                    'data' => $validator->errors(),
                ],
                422
            )
        );
    }

    public function messages()
    {
        return [];
    }
}
