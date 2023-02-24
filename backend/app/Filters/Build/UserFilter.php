<?php

namespace App\Filters\Build;

class UserFilter extends \App\Filters\Filter
{

    public function filter(\Illuminate\Database\Eloquent\Builder $query): void
    {
        $userid = $this->filterFields?->userId;
        if (isset($userid)) {
            $query->where('user_id', $userid);
        }
    }
}
