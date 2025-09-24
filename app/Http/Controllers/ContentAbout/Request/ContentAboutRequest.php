<?php

namespace App\Http\Controllers\ContentAbout\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ContentAboutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // Allow partial updates (e.g., toggling publish) without forcing content
            'content' => 'sometimes|required|array',
            'version' => 'nullable|integer',
            'is_published' => 'nullable|boolean',
            // Allow reusing the same URL across versions
            'url' => 'sometimes|string|max:255'
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
