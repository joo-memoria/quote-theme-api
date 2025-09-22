<?php

namespace App\Http\Controllers\User\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $id = $this->route('record_id');
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                    'password' => ['required', 'string', 'min:8'],
                    'role_id' => ['nullable', 'integer', 'exists:roles,id'],
                ];

            case 'PATCH':
                return [
                    'name' => ['sometimes', 'required', 'string', 'max:255'],
                    'email' => [
                        'sometimes', 'required', 'email', 'max:255',
                        Rule::unique('users', 'email')->ignore($id),
                    ],
                    'password' => ['sometimes', 'nullable', 'string', 'min:8'],
                    'role_id' => ['sometimes', 'nullable', 'integer', 'exists:roles,id'],
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