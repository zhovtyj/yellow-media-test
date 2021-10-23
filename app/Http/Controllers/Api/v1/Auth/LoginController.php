<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Exceptions\InvalidCredentialsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws InvalidCredentialsException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            throw new InvalidCredentialsException();
        }

        $user->api_token = base64_encode(Str::random(60));
        $user->save();

        return response()->json([
            'api_token' => $user->api_token
        ]);
    }
}
