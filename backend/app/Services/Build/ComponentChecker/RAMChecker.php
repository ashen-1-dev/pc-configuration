<?php

namespace App\Services\Build\ComponentChecker;

use App\Http\Controllers\Build\dto\CompatibleChecker\ComponentStatusDto;
use App\Http\Controllers\Build\dto\CompatibleChecker\NotCompatibleComponentDto;
use App\Http\Controllers\Component\dto\GetComponentDto;
use Spatie\LaravelData\DataCollection;

class RAMChecker implements ComponentChecker
{
    public function check(GetComponentDto $source, DataCollection $targets): ComponentStatusDto
    {
        //FIXME: Можно сделать класс абстрактным вплоть до самого цикла,
        // а тело цикла вынести до абстрактного метода, проверку на тип можно сделать в Checkers
        $isCompatible = true;
        $notCompatibleComponents = [];
        if ($source->type !== 'ram') {
            //FIXME: придумать, как система должна реагировать на неверный компонент (exception как вариант)
        }
        foreach ($targets as $otherComponent) {
            $isComponentCompatible = true;
            if ($otherComponent->type == 'motherboard') {
                [
                    'compatible' => $isComponentCompatible,
                    'message' => $message
                ] = Checkers::checkRamWithMotherboard($source, $otherComponent);
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
