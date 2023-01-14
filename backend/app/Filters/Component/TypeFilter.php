<?php

namespace App\Filters\Component;

use Illuminate\Database\Eloquent\Builder;

class TypeFilter extends \App\Filters\Filter
{

    public function filter(Builder $query): void
    {
        $type = $this->filterFields?->type;
        if (isset($type)) {
            $query->whereRelation('type', 'name', '=', $type);
        }
    }
}
