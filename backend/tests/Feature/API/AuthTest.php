<?php


namespace API;

use Illuminate\Testing\Fluent\AssertableJson;

class AuthTest extends APITest
{

    public function testRegister(): void
    {
        $userData =
            [
                'email' => 'test' . random_int(1, 100000) . '@example.ru',
                'password' => '123123',
                'lastName' => 'John',
                'firstName' => 'Doe',
            ];

        $response = $this->post('api/register', $userData);
        $response
            ->assertStatus(201)
            ->assertJson(
                fn(AssertableJson $json) => $json->has('accessToken')
            );
    }

    public function testRegisterWithErrorUserExist(): void
    {
        $userData =
            [
                'email' => 'test' . random_int(1, 100000) . '@example.ru',
                'password' => '123123',
                'lastName' => 'John',
                'firstName' => 'Doe',
            ];


        $this->post('api/register', $userData);

        $response = $this->post('api/register', $userData);

        $response->assertStatus(404);
    }

    public function testLogin(): void
    {
        $userData =
            [
                'email' => 'test@example.ru',
                'password' => '123123',
                'firstName' => 'John',
                'lastName' => 'Doe',
            ];

        $this->post('api/register', $userData);

        $response = $this->post('api/login', ['password' => $userData['password'], 'email' => $userData['email']]);

        $response
            ->assertStatus(200)
            ->assertJson(
                fn(AssertableJson $json) => $json->has('accessToken')
            );
    }

    public function testLoginWithErrorIncorrectData(): void
    {
        $userData =
            [
                'email' => 'test@example.ru',
                'password' => '1231234',
            ];
        $response = $this->post('api/login', $userData);

        $response->assertStatus(401);
    }
}
