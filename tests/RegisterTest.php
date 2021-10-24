<?php

use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
    public function test_registration_successful()
    {
        $user = User::factory()->make();

        $this->post('/api/user/register', [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'password' => '123456',
        ]);

        $this->assertResponseStatus(201);
    }

    public function test_registration_failed()
    {
        $user = User::inRandomOrder()->first();

        $this->post('/api/user/register', [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'password' => '123456',
        ]);

        $this->assertResponseStatus(422);
    }

    public function test_name_too_long()
    {
        $user = User::factory()->make();

        $this->post('/api/user/register', [
            'first_name' => Str::random(256),
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'password' => '123456',
        ]);

        $this->assertResponseStatus(422);
    }
}
