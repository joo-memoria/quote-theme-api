<?php

namespace App\Http\Controllers\Auth\Service;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthService extends Controller
{
	/**
	 * Attempt login and return user + token
	 *
	 * @param array|null $data
	 * @return mixed
	 */
	public function login(?array $data): mixed
	{
		try {
			$credentials = [
				'email' => $data['email'] ?? null,
				'password' => $data['password'] ?? null,
			];

			if (! Auth::attempt($credentials)) {
				return [
					'response' => false,
					'message' => 'Invalid credentials.',
					'status' => 401,
				];
			}

			/** @var User $user */
			$user = User::where('email', $credentials['email'])->firstOrFail();
			$token = $user->createToken('api')->plainTextToken;

			return [
				'response' => true,
				'message' => 'Logged in.',
				'data' => [
					'token' => $token,
					'user' => $user,
				],
			];
		} catch (\Exception $e) {
			return $this->throwError($e);
		}
	}

	/**
	 * Log out current token
	 */
	public function logout(): mixed
	{
		try {
			$user = \Illuminate\Support\Facades\Auth::user();
			if ($user && $user->currentAccessToken()) {
				$user->currentAccessToken()->delete();
			}
			return true;
		} catch (\Exception $e) {
			return $this->throwError($e);
		}
	}
}

