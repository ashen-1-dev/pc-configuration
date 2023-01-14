<?php

namespace App\Filters\Component;

use Illuminate\Database\Eloquent\Builder;

class SearchFilter extends \App\Filters\Filter
{

    public function filter(Builder $query): void
    {
        $search = $this->filterFields?->search;
        if (isset($search)) {
            $query->where('name', 'like', "%$search%");
        }
    }
}
