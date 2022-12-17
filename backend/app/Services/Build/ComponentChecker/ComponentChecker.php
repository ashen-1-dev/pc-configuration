<?php

namespace App\Services\Build\ComponentChecker;

use App\Http\Controllers\Build\dto\BuildChecker\CompatibleChecker\CheckerResult;
use App\Http\Controllers\Build\dto\BuildChecker\CompatibleChecker\ComponentStatusDto;
use App\Http\Controllers\Build\dto\BuildChecker\CompatibleChecker\NotCompatibleComponentDto;
use App\Http\Controllers\Component\dto\GetComponentDto;
use Spatie\LaravelData\DataCollection;

abstract class ComponentChecker
{
    public function check(GetComponentDto $source, DataCollection $targets): ComponentStatusDto
    {
        $isCompatible = true;
        $notCompatibleComponents = [];
        foreach ($targets as $otherComponent) {
            if ($source->id == $otherComponent->id) {
                continue;
            }

            [
                'isCompatible' => $isComponentCompatible,
                'message' => $message
            ] = get_object_vars($this->iterate($source, $otherComponent));


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
            notCompatibleComponents: empty(array_filter($notCompatibleComponents))
                ? null
                : NotCompatibleComponentDto::collection($notCompatibleComponents)
        );
    }

    abstract public function iterate(GetComponentDto $source, GetComponentDto $otherComponent): CheckerResult;
}
