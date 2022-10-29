<?php

namespace Database\Seeders;

use App\Core\Components\RequiredAttributes\RequiredAttributesForCase as PCCase;
use App\Core\Components\RequiredAttributes\RequiredAttributesForCPU as CPU;
use App\Core\Components\RequiredAttributes\RequiredAttributesForDiskDrive as DiskDrive;
use App\Core\Components\RequiredAttributes\RequiredAttributesForGPU as GPU;
use App\Core\Components\RequiredAttributes\RequiredAttributesForMotherboard as Motherboard;
use App\Core\Components\RequiredAttributes\RequiredAttributesForPowerSupply as PowerSupply;
use App\Core\Components\RequiredAttributes\RequiredAttributesForRAM as RAM;
use App\Models\Components\Type;
use DB;
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
        DB::table('required_attributes')->insert($this->bootstrap());
    }

    private function bootstrap(): array
    {
        $component_types = Type::where('required', '=', true)->get();
        $requiredAttributes = [
            PCCase::$name => PCCase::getAttributes(),
            RAM::$name => RAM::getAttributes(),
            CPU::$name => CPU::getAttributes(),
            GPU::$name => GPU::getAttributes(),
            DiskDrive::$name => DiskDrive::getAttributes(),
            PowerSupply::$name => PowerSupply::getAttributes(),
            Motherboard::$name => Motherboard::getAttributes(),
        ];
        $result = [];
        foreach ($component_types as $component_type) {
            $attributes = $requiredAttributes[$component_type->name];
            foreach ($attributes as $attribute) {
                $result[] = [
                    'component_type_id' => $component_type->id,
                    'name' => $attribute
                ];
            }
        }
        return $result;
    }
}
