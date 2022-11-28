<?php

namespace App\Services\Build\ComponentChecker;

use App\Http\Controllers\Build\dto\CompatibleChecker\ComponentStatusDto;
use App\Http\Controllers\Build\dto\CompatibleChecker\NotCompatibleComponentDto;
use App\Http\Controllers\Component\dto\GetComponentDto;
use Spatie\LaravelData\DataCollection;

class CaseChecker implements ComponentChecker
{

    public function check(GetComponentDto $source, DataCollection $targets): ComponentStatusDto
    {
        $isCompatible = true;
        $notCompatibleComponents = [];
        foreach ($targets as $otherComponent) {
            $isComponentCompatible = true;
            if ($otherComponent->type == 'motherboard') {
                [
                    'compatible' => $isComponentCompatible,
                    'message' => $message
                ] = Checkers::checkCaseWithMotherboard($source, $otherComponent);
            }
            if (!$isComponentCompatible) {
                $notCompatibleComponents[] = new NotCompatibleComponentDto(
                    component: $otherComponent,
                    message: $message ?? ''
                );
            }
            $isCompatible &= $isComponentCompatible;
        }
        return new ComponentStatusDto(
            componentId: $source->id,
            isCompatible: $isCompatible,
            notComaptibleComponents: empty(array_filter($notCompatibleComponents))
                ? null
                : NotCompatibleComponentDto::collection($notCompatibleComponents)
        );
    }
}
