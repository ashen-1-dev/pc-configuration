<?php

namespace API;

use App\Http\Controllers\Component\dto\CreateAttributeDto;
use App\Http\Controllers\Component\dto\CreateComponentDto;
use App\Http\Controllers\Component\dto\GetComponentDto;
use Illuminate\Testing\Fluent\AssertableJson;

class ComponentTest extends APITest
{

    public function testCreateComponent(): void
    {
        $component = $this->getTestComponent();

        $response = $this->asAdmin()->post('/api/components', $component->toArray());


        $response->assertStatus(201)
            ->assertJson(fn(AssertableJson $json) => $json->hasAll(getClassProperties(GetComponentDto::class))
            );
    }


    public function testGetComponents(): void
    {
        $response = $this->get('/api/components');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            if ($json->toArray()) {
                $json->first(fn(AssertableJson $json) => $json->hasAny(getClassProperties(GetComponentDto::class)));
            }
        }
        );
    }

    public function testDeleteComponent()
    {
        $component = $this->asAdmin()->post('/api/components', $this->getTestComponent()->toArray());

        $response = $this->asAdmin()->delete('/api/components/' . $component['id']);

        $response->assertStatus(200);
    }

    public function testCreateComponentWithoutNecessaryAttribute(): void
    {
        $component = $this->getTestComponent();

        unset($component->attributes[0]);

        $response = $this->asAdmin()->post('/api/components', $component->toArray());

        $response->assertStatus(422);
    }


    private function getTestComponent(): CreateComponentDto
    {
        return new CreateComponentDto(
            name: 'Test component',
            description: 'this is test component',
            type: 'ram',
            photo: null,
            attributes: CreateAttributeDto::collection([
                new CreateAttributeDto(name: 'number_of_modules', value: 1),
                new CreateAttributeDto(name: 'frequency', value: 3200),
                new CreateAttributeDto(name: 'capacity', value: 16),
                new CreateAttributeDto(name: 'memory_type', value: 'ddr3'),
            ])
        );
    }
}
