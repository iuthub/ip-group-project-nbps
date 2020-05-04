<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountUpdateFormRequest;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{

    public function show()
    {
        return User::with('profile')->find(Auth::guard('api')->user()->id);
    }

    public function update(AccountUpdateFormRequest $request)
    {
        $user = Auth::guard('api')->user();
        $validated = $request->validate(array_merge($request->rules(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ]
        ]));
        $user->profile->fill($request->except(['name', 'email', 'password']));
        $user->fill($request->only(['name', 'email', 'password']));
        if (!$user->push()) {
            return response()->json([
                'message' => 'Unable to perform update action'
            ], 422);
        }
        return response()->json([
            'message' => 'Profile has been updated'
        ]);
    }
}
