<?php

namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;

abstract class QueryFilter
{
    /** @var array<string, mixed> */
    protected object $filterFields;

    /** @var array<string> */
    protected array $filters = [];

    public function __construct(object $filterFields)
    {
        $this->filterFields = $filterFields;
    }

    public function apply(Builder $query): Builder
    {
        if (empty($this->filterFields)) return $query;
        foreach ($this->filters as $classFilter) {
            if (class_exists($classFilter)) {
                $instance = new $classFilter($this->filterFields);
                $instance->filter($query);
            }
        }
        return $query;
    }
}
