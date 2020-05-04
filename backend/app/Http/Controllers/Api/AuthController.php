<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginFormRequest;
use App\Http\Requests\UserSignupFormRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signup']]);
    }

    public function login(UserLoginFormRequest $request)
    {
        if ($token = Auth::guard('api')->attempt($request->validated())) {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',   
                'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
            ], 200);
        }

        return response()->json([
            'message' => 'Incorrect credentials',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function refresh()
    {
        return response()->json([
            'access_token' => Auth::guard('api')->refresh(),
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ], 200);
    }

    public function signup(UserSignupFormRequest $request)
    {
        $data = $request->validated();
        $user = User::create(array_merge($data, [
            'password' => Hash::make($data['password'])
        ]));

        return response()->json([
            'message' => 'You have successfully been registered. Please log in',
            'credentials' => $user
        ], Response::HTTP_OK);
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
