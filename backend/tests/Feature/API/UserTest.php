<?php

namespace API;

use App\Http\Controllers\User\dto\EditUserDto;
use App\Http\Controllers\User\dto\GetUserDto;
use Illuminate\Testing\Fluent\AssertableJson;

class UserTest extends APITest
{
    public function testGetAuthUser(): void
    {
        $response = $this->asUser()->get('api/users/me');

        $response->assertStatus(200)->assertJson(fn(AssertableJson $json) => $json->hasAll(getClassProperties(GetUserDto::class)));
    }

    public function testGetUsers(): void
    {
        $response = $this->asUser()->get('api/users');

        $response->assertStatus(200)->assertJson(
            fn(AssertableJson $json) => $json->first(
                fn(AssertableJson $json) => $json->hasAll(getClassProperties(GetUserDto::class))
            ));
    }

    public function testEditUser()
    {
        $updateUserDto = new EditUserDto(null, 'Nick', null, null);

        $response = $this->asUser()->post('api/user', (array)$updateUserDto);

        $response->assertStatus(200)->assertJson(
            fn(AssertableJson $json) => $json->hasAll(getClassProperties(GetUserDto::class)))->assertJson(['firstName' => 'Nick']
        );
    }
}
