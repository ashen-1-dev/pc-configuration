<?php

namespace App\Services\Build\ComponentChecker;

use App\Http\Controllers\Build\dto\CompatibleChecker\ComponentStatusDto;
use App\Http\Controllers\Build\dto\CompatibleChecker\NotCompatibleComponentDto;
use App\Http\Controllers\Component\dto\GetComponentDto;
use Spatie\LaravelData\DataCollection;

class GPUChecker implements ComponentChecker
{

    /**
     * @inheritDoc
     */
    public function check(GetComponentDto $source, DataCollection $targets): ComponentStatusDto
    {
        $isCompatible = true;
        $notCompatibleComponents = [];

        if ($source->type !== 'gpu') {
            //FIXME: придумать, как система должна реагировать на неверный компонент (exception как вариант)
        }

        foreach ($targets as $otherComponent) {
            $isComponentCompatible = true;

            if ($otherComponent->type == 'case') {
                [
                    'compatible' => $isComponentCompatible,
                    'message' => $message
                ] = Checkers::checkGPUWithCase($source, $otherComponent);
            }

            if ($otherComponent->type == 'powersupply') {
                [
                    'compatible' => $isComponentCompatible,
                    'message' => $message
                ] = Checkers::checkGPUWithPowerSupply($source, $otherComponent);
            }

            $isCompatible &= $isComponentCompatible;

            if (!$isComponentCompatible) {
                $notCompatibleComponents[] = new NotCompatibleComponentDto(
                    component: $otherComponent,
                    message: $message ?? ''
                );
            }
        }
        return new ComponentStatusDto(
            componentId: $source->id,
            isCompatible: $isCompatible,
            notComaptibleComponents: empty($notCompatibleComponentDto)
                ? null
                : NotCompatibleComponentDto::collection($notCompatibleComponents)
        );
    }
}
