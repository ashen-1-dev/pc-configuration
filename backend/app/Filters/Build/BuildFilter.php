<?php

namespace App\Filters\Build;


class BuildFilter extends \App\Filters\QueryFilter
{
    protected array $filters = [
        SearchFilter::class,
        UserFilter::class,
        ReadyFilter::class
    ];
}
