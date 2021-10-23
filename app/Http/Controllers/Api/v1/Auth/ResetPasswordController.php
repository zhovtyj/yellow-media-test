<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /**
     * Just for demo purpose
     * We can return api token, and give ability for auth user to change his password
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function reset(ResetPasswordRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $passwordReset = PasswordReset::where('token', $validated['token'])->firstOrFail();
        $user = User::where('email', $passwordReset->email)->first();

        $user->api_token = base64_encode(Str::random(60));
        $user->save();

        return response()->json([
            'api_token' => $user->api_token
        ]);
    }
}
