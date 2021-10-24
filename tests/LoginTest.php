<?php

use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    public function test_login_successful()
    {
        $user = User::factory()->make();
        $user->save();

        $this->post('/api/user/sign-in', [
            'email' => $user->email,
            'password' => '123456',
        ]);

        $this->seeJsonStructure(['api_token']);
    }

    public function test_invalid_credentials()
    {
        $user = User::factory()->make();
        $user->save();

        $this->post('/api/user/sign-in', [
            'email' => $user->email,
            'password' => '123',
        ]);

        $this->seeJson(["message" => "Invalid credentials"]);
    }

    public function test_email_required()
    {
        $this->post('/api/user/sign-in', [
            'password' => '123',
        ]);

        $this->seeJson(["email" => ["The email field is required."]]);
    }

    public function test_password_required()
    {
        $user = User::factory()->make();
        $user->save();

        $this->post('/api/user/sign-in', [
            'email' => $user->email,
        ]);

        $this->seeJson(["password" => ["The password field is required."]]);
    }
}
