<?php

namespace Rezyon\Applications\TourismCompanyUser\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Rezyon\Applications\TourismCompanyUser\Http\Requests\LoginRequest;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $token = Auth::guard('tourism-user-api')->attempt($credentials);

        if (! $token) {
            return response()->json(
                [
                    'message' => trans('auth.unauthorized'),
                    'errors' => [
                        'auth' => [
                            trans('auth.unauthorized'),
                        ],
                    ],
                ],
                ResponseAlias::HTTP_BAD_REQUEST
            );
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('tourism-user-api')->factory()->getTTL() * 60,
        ]);
    }

    public function me(): JsonResponse
    {
          return response()->json(Auth::user()->load(['company', 'hotel.hotel']));
    }

    public function refresh(): JsonResponse
    {
        return response()->json([
            'access_token' => Auth::refresh(),
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
        ]);
    }
    public function logout(): JsonResponse
    {
        Auth::logout();
        return response()->json(['message' => __('auth.logout')]);
    }

}