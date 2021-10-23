<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    /**
     * Just for demo purpose
     * @param $token
     */
    public function reset($token)
    {
        return $token;
    }
}
