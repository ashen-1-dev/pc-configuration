<?php

namespace Database\Seeders;

use App\Models\Component\Type as ComponentType;
use App\Services\Build\Enums\RequiredComponentsForBuild;
use Illuminate\Database\Seeder;

class RequiredComponentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $componentTypes = RequiredComponentsForBuild::cases();
        foreach ($componentTypes as $componentType) {
            ComponentType::create(['name' => $componentType->value, 'required' => true])->save();
        }
    }
}
