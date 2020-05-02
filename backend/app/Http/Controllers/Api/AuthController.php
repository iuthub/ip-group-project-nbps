<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = Auth::guard()->attempt($credentials)) {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => Auth::guard()->factory()->getTTL() * 60
            ], 200);
        }

        return response()->json([
            'error' => 'Unauthorized',
        ], 401);
    }

    public function refresh()
    {
        return response()->json([
            'access_token' => Auth::guard()->refresh(),
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard()->factory()->getTTL() * 60
        ], 200);
    }

    public function me()
    {
        return response()->json(Auth::guard()->user());
    }

    public function logout()
    {
        Auth::guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
