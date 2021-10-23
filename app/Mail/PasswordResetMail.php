<?php

namespace App\Mail;

use App\Models\PasswordReset;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $passwordReset;

    /**
     * @param PasswordReset $passwordReset
     */
    public function __construct(PasswordReset $passwordReset)
    {
        $this->passwordReset = $passwordReset;
    }

    /**
     * @return PasswordResetMail
     */
    public function build(): PasswordResetMail
    {
		return $this->subject('Password Reset')
			->view('emails.password')
            ->with([
                'url' => route('password.reset', ['token' => $this->passwordReset->token])
            ]);
    }
}
