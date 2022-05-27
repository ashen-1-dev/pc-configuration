<?php

namespace App\Services\Component;

class AttributeService
{
    public function createAttributeWithValueMany($attributes)
    {
        $attributes->validate();
    }
}