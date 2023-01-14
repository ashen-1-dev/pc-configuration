<?php

namespace Database\Seeders;


use App\Core\Components\CPU\CPU;
use App\Core\Components\Diskdrive\DiskDrive;
use App\Core\Components\GPU\GPU;
use App\Core\Components\Motherboard\Motherboard;
use App\Core\Components\PCCase\PCCase;
use App\Core\Components\PowerSupply\PowerSupply;
use App\Core\Components\RAM\RAM;
use App\Models\Component\RequiredAttribute;
use App\Models\Component\Type;
use Illuminate\Database\Seeder;

class RequiredAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RequiredAttribute::insert($this->bootstrap());
    }

    private function bootstrap(): array
    {
        $componentTypes = Type::where('required', '=', true)->get();
        $requiredAttributes = [
            'case' => new PCCase(),
            'ram' => new RAM(),
            'cpu' => new CPU(),
            'gpu' => new GPU(),
            'diskdrive' => new DiskDrive(),
            'powersupply' => new PowerSupply(),
            'motherboard' => new Motherboard(),
        ];
        $result = [];
        //FIXME: optimize
        foreach ($componentTypes as $componentType) {
            $attributes = $requiredAttributes[$componentType->name]->attributes;
            foreach ($attributes as $name => $attribute) {
                $result[] = [
                    'component_type_id' => $componentType->id,
                    'name' => $name,
                    'list' => isset($attribute['list']) ? json_encode($attribute['list']) : null
                ];
            }
        }
        return $result;
    }
}
