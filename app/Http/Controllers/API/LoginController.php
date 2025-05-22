<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if (filled($user)) {
            if (Hash::check($request->input('password'), $user->password)) {
                $token = $user->createToken('api')->plainTextToken;

                return UserResource::make($user)->additional(['token' => $token]);
            }
        }

        return response()->json(['errors' => ['email' => 'invalid credentials']], 442);
    }
}
