<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{

    protected readonly object $filterFields;

    public function __construct(object $filterFields)
    {
        $this->filterFields = $filterFields;
    }

    abstract public function filter(Builder $query): void;
}
