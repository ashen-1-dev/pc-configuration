<?php

namespace App\Filters\Build;

class SearchFilter extends \App\Filters\Filter
{

    public function filter(\Illuminate\Database\Eloquent\Builder $query): void
    {
        $search = $this->filterFields?->q;
        if (isset($search)) {
            $query->where('name', 'like', "%$search%");
        }
    }
}
