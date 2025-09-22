<?php

namespace App\Http\Controllers\Auth\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AuthRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		// Login validation (used for POST /auth/login)
		switch ($this->method()) {
			case 'POST':
				return [
					'email' => ['required', 'email'],
					'password' => ['required', 'string', 'min:6'],
				];
			default:
				return [];
		}
	}

	protected function failedValidation(Validator $validator)
	{
		throw new HttpResponseException(
			response()->json([
				'response' => false,
				'message' => $validator->errors()->first(),
				'data' => $validator->errors(),
			], 422)
		);
	}
}

