<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\Request\AuthRequest;
use App\Http\Controllers\Auth\Service\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected readonly AuthService $auth_service
    ) {}

    public function login(AuthRequest $request)
    {
        $data = $request->validated();
        $result = $this->auth_service->login($data);
        if ($result instanceof \Illuminate\Http\JsonResponse) {
            return $result;
        }
        if (is_array($result) && ($result['response'] ?? false) === false) {
            $status = $result['status'] ?? 400;
            return response()->json($result, $status);
        }
        return response()->json($result);
    }

    public function logout()
    {
        $result = $this->auth_service->logout();
        if ($result instanceof \Illuminate\Http\JsonResponse) {
            return $result;
        }
        return response()->json($result);
    }

    public function me(Request $request)
    {
        try {
            return response()->json([
                'response' => true,
                'data' => $request->user(),
            ]);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }
}
