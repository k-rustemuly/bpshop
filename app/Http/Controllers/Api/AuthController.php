<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends BaseController
{

    public function register(RegisterRequest $request)
    {
        $signUpFields = $request->validated();
        $signUpFields["password"] = Hash::make($signUpFields["password"]);

        $user = User::create($signUpFields);
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success(
            ['user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
            ]
        );
    }
}
