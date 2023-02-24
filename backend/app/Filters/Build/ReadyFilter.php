<?php

namespace App\Filters\Build;

class ReadyFilter extends \App\Filters\Filter
{

    public function filter(\Illuminate\Database\Eloquent\Builder $query): void
    {
        $ready = $this->filterFields?->ready;
        if (isset($ready)) {
            $query->where('is_ready', true);
        }
    }
}
