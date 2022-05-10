<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Faker\Generator;
use PHPUnit\Framework\Test;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $userData =
            [
                'email' => 'test' . random_int(10000, 50000) . '@example.ru',
                'password' => '123123',
                'last_name' => 'John',
                'first_name' => 'Doe',
            ];
        $response = $this->post('/login/register', $userData);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
        ]);
    }

    public function testRegisterWithErrorUserExist()
    {
        $userData =
            [
                'email' => 'test@example.ru',
                'password' => '123123',
                'last_name' => 'John',
                'first_name' => 'Doe',
            ];
        $response = $this->post('/login/register', $userData);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => false,
        ]);
    }

    public function testLogin()
    {
        $userData =
            [
                'email' => 'test@example.ru',
                'password' => '123123',
            ];
        $response = $this->post('/login/auth', $userData);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
    }

    public function testLoginWithErrorIncorrectData()
    {
        $userData =
            [
                'email' => 'test@example.ru',
                'password' => '1231234',
            ];
        $response = $this->post('/login/auth', $userData);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => false,
        ]);
    }
}
