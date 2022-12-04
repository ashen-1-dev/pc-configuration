<?php

namespace Database\Seeders;

use App\Models\Component\Type as ComponentType;
use App\Services\Build\RequiredComponentsForBuild;
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
        $component_types = RequiredComponentsForBuild::cases();
        foreach ($component_types as $component_type) {
            ComponentType::create(['name' => $component_type->value, 'required' => true])->save();
        }
    }
}
