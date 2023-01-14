<?php

namespace App\Services\Build;

use App\Http\Controllers\Build\dto\BuildChecker\CompatibleChecker\BuildCompatibleStatus;
use App\Http\Controllers\Build\dto\BuildChecker\CompatibleChecker\ComponentStatusDto;
use App\Http\Controllers\Build\dto\BuildChecker\EnergyConsumptionStatus;
use App\Http\Controllers\Build\dto\BuildChecker\RequirementComponentsStatus;
use App\Http\Controllers\Build\dto\CheckBuildResult;
use App\Http\Controllers\Build\dto\CreateBuildDto;
use App\Http\Controllers\Build\dto\EditBuildDto;
use App\Http\Controllers\Build\dto\GetBuildDto;
use App\Http\Controllers\Build\dto\RawBuildDto;
use App\Http\Controllers\Component\dto\GetComponentDto;
use App\Models\Component\Component;
use App\Services\Build\ComponentChecker\Checkers;
use App\Services\Build\Enums\RequiredComponentsForBuild;
use Spatie\LaravelData\DataCollection;

class BuildChecker
{

    public function checkBuildIsReady(GetBuildDto|RawBuildDto|CreateBuildDto|EditBuildDto $dto): CheckBuildResult
    {

        $components = $dto instanceof GetBuildDto ?
            $dto->components :
            GetComponentDto::collection(Component::findMany($dto->componentsIds));
        $buildCompatibleStatus = $this->checkCompatible($components);
        $energyConsumptionStatus = $this->checkEnergyConsumption($components);
        $requirementComponentsStatus = $this->checkForRequiredComponents($components);

        $result = new CheckBuildResult(
            isReady: true,
            buildCompatibleStatus: $buildCompatibleStatus,
            energyConsumptionStatus: $energyConsumptionStatus,
            requirementComponentsStatus: $requirementComponentsStatus,
        );

        if (
            !$buildCompatibleStatus->isCompatible ||
            !$energyConsumptionStatus->isEnough ||
            !$requirementComponentsStatus->success
        ) {
            $result->isReady = false;
        }

        return $result;
    }

    /**
     * @param DataCollection<GetComponentDto> $getComponentsDto
     */
    public function checkCompatible(DataCollection $getComponentsDto): BuildCompatibleStatus
    {
        $isCompatible = true;
        $componentsStatus = [];
        foreach ($getComponentsDto as $component) {
            $checkerClass = Checkers::getChecker($component->type);
            if (!class_exists($checkerClass)) {
                continue;
            }
            $checkerInstance = new $checkerClass();
            $status = $checkerInstance->check($component, $getComponentsDto);

            if (!$status->isCompatible) {
                $isCompatible = false;
                $componentsStatus[] = $status;
            }
        }

        return new BuildCompatibleStatus(
            isCompatible: $isCompatible,
            componentsStatus: ComponentStatusDto::collection($componentsStatus)
        );
    }

    /**
     * @param DataCollection<GetComponentDto> $getComponentsDto
     */
    public function checkForRequiredComponents(DataCollection $components): RequirementComponentsStatus
    {
        $requiredComponents = RequiredComponentsForBuild::cases();
        $componentsTypes = $components->toCollection()->pluck('type')->toArray();

        $result = new RequirementComponentsStatus(success: true, missingComponentsType: []);
        foreach ($requiredComponents as $requiredComponent) {
            if (!in_array($requiredComponent->value, $componentsTypes)) {
                $result->success = false;
                $result->missingComponentsType[] = $requiredComponent;
            }
        }

        return $result;
    }

    /**
     * @param DataCollection<GetComponentDto> $getComponentsDto
     */
    public function checkEnergyConsumption(
        DataCollection $getComponentsDto
    ): EnergyConsumptionStatus|null
    {
        $psPower = 0;
        $totalConsumption = 0;
        $result = new EnergyConsumptionStatus(
            isEnough: true,
            totalConsumption: $totalConsumption,
            psPower: $psPower,
        );

        $totalConsumption = $this->countEnergyConsumption($getComponentsDto);
        $ps = $getComponentsDto->where('type', '=', 'powersupply')->first();

        if (!isset($ps)) {
            $result->isEnough = false;
        } else {
            $psPower = $ps->attributes
                ->where('name', '=', 'power')
                ->first()
                ->value;
            $result->psPower = $psPower;
        }

        if ($psPower < $totalConsumption) {
            $result->isEnough = false;
        }
        return $result;
    }


    /**
     * @param DataCollection<GetComponentDto> $getComponentsDto
     */
    private function countEnergyConsumption(DataCollection $getComponentsDto)
    {
        $total = 0;
        foreach ($getComponentsDto as $component) {
            $attribute = $component
                ->attributes
                ->where('name', '=', 'energy_consumption')
                ->first();

            if (!isset($attribute)) {
                continue;
            }

            if (is_int($attribute->value)) {
                $total += $attribute->value;
            }
        }

        return $total;
    }
}
