<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\SignUpRequest;
use App\Http\Requests\Api\SignInRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{

    public function signUp(SignUpRequest $request)
    {
        $signUpFields = $request->validated();
        $signUpFields["password"] = Hash::make($signUpFields["password"]);

        $user = User::create($signUpFields);
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success(
            [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        );
    }

    public function signIn(SignInRequest $request)
    {
        $userFields = $request->validated();
        if(!Auth::attempt($userFields))
        {
            return $this->unauthorized("Электронная почта или пароль неверный!");
        }

        $user = User::where('email', $userFields['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success(
            [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        );
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success();
    }
}
