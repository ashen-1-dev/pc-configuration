<?php

namespace App\Services\Build;

use App\Http\Controllers\Build\dto\CompatibleChecker\BuildCompatibleStatusDto;
use App\Http\Controllers\Build\dto\CompatibleChecker\ComponentStatusDto;
use App\Http\Controllers\Component\dto\GetComponentDto;
use App\Services\Build\ComponentChecker\Checkers;
use Spatie\LaravelData\DataCollection;

class CompatibleChecker
{
    /**
     * @param DataCollection<GetComponentDto> $getComponentsDto
     */
    public function checkCompatible(DataCollection $getComponentsDto): BuildCompatibleStatusDto
    {
        $componentsStatus = [];
        foreach ($getComponentsDto as $component) {
            $checkerClass = Checkers::getChecker($component->type);
            if (!class_exists($checkerClass)) {
                continue;
            }
            $checkerInstance = new $checkerClass();
            $componentsStatus[] = $checkerInstance->check($component, $getComponentsDto);
        }

        return new BuildCompatibleStatusDto(
            isCompatible: $this->checkIfCompatible($componentsStatus),
            componentsStatus: ComponentStatusDto::collection($componentsStatus)
        );
    }

    private function checkIfCompatible(array $componentsStatus)
    {
        $isCompatible = true;
        foreach ($componentsStatus as $componentStatus) {
            $isCompatible &= $componentStatus->isCompatible;
        }
        return $isCompatible;
    }
}
