<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_login()
    {
        $token = $this->post('/api/v1/login', [
            "email" => "admin@test.com",
            "password" => "password"
        ]);

        $token->assertJsonStructure([
            'token',
            'user' => [
                'id',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
            ],
        ]);
    }
}
