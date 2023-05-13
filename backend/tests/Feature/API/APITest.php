<?php

namespace API;

use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class APITest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }


    public function asAdmin(): static
    {
        $token = $this->createAdminToken();
        $this->withHeaders(['Authorization' => "Bearer $token"]);
        return $this;
    }

    public function asUser(): static
    {
        $token = $this->createUserToken();
        $this->withHeaders(['Authorization' => "Bearer $token"]);
        return $this;
    }

    public function createUserToken()
    {
        $user = User::updateOrCreate([
            'email' => 'user@test.ru',
        ], [
            'first_name' => 'user',
            'last_name' => 'user',
            'password' => '123123'
        ]);

        $user->roles()->create(['name' => 'user']);

        return $user->createToken('accessToken')->plainTextToken;
    }

    public function createAdminToken()
    {
        $user = User::updateOrCreate([
            'email' => 'admin@test.ru',
        ], [
            'first_name' => 'admin',
            'last_name' => 'admin',
            'password' => '123123'
        ]);

        $user->roles()->create(['name' => 'admin']);

        return $user->createToken('accessToken')->plainTextToken;
    }
}
