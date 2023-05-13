<?php

namespace API;

use App\Http\Controllers\Build\dto\CheckBuildResult;
use App\Http\Controllers\Build\dto\CreateBuildDto;
use App\Http\Controllers\Build\dto\GetBuildDto;
use App\Http\Controllers\Component\dto\CreateAttributeDto;
use App\Http\Controllers\Component\dto\CreateComponentDto;
use App\Services\Component\ComponentService;
use Illuminate\Testing\Fluent\AssertableJson;

class BuildTest extends APITest
{

    private readonly ComponentService $componentService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->componentService = $this->app->make(ComponentService::class);
    }

    public function testGetBuilds()
    {
        $response = $this->get('api/builds/');

        $response->assertStatus(200)->assertJson(
            function (AssertableJson $json) {
                if ($json->toArray()) {
                    $json->first(
                        fn(AssertableJson $json) => $json->hasAll(getClassProperties(GetBuildDto::class))
                    );
                }
            }
        );
    }

    public function testCreateBuild()
    {
        $build = $this->getTestBuild();

        $response = $this->asUser()->post('api/builds', (array)$build);

        $response->assertStatus(201)->assertJson(
            fn(AssertableJson $json) => $json->hasAll(getClassProperties(GetBuildDto::class))
        );
    }

    public function testBuildIsNotReady()
    {
        $build = $this->getTestBuild();

        $response = $this->asUser()->post('api/builds/check', (array)$build);

        $response->assertStatus(200)
            ->assertJson(['isReady' => false])
            ->assertJson(
                fn(AssertableJson $json) => $json->hasAll(getClassProperties(CheckBuildResult::class))
            );
    }

    private function getTestBuild()
    {
        $createComponentDto = new CreateComponentDto(
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


        $component = $this->componentService->createComponent($createComponentDto);
        return new CreateBuildDto(
            name: 'Test build',
            description: 'this is a test build',
            componentsIds: [$component->id]
        );
    }
}
