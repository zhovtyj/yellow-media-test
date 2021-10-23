<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendResetLinkEmailRequest;
use App\Mail\PasswordResetMail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * @param SendResetLinkEmailRequest $request
     * @return JsonResponse
     */
    public function sendResetLinkEmail(SendResetLinkEmailRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->firstOrFail();

        $passwordReset = PasswordReset::create([
            'email' => $user->email,
            'token' => base64_encode(Str::random(40))
        ]);

        Mail::to($user)
            ->send(new PasswordResetMail($passwordReset));

        return response()->json([
            'message' => 'Password reset link sent to you email'
        ]);
    }
}
