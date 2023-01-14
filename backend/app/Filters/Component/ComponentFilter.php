<?php

namespace App\Filters\Component;

use App\Filters\QueryFilter;

class ComponentFilter extends QueryFilter
{
    protected array $filters = [
        TypeFilter::class,
        SearchFilter::class,
    ];
}
