<?php

namespace App\Http\Controllers\Build\dto\BuildChecker;


class RequirementComponentsStatus
{
    public function __construct(
        public bool  $success,
        public array $missingComponentsType
    )
    {
    }
}
