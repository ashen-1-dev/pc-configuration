<?php

namespace App\Policies;

use App\Models\Build\Build;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuildPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Build $build)
    {
        return $user->id === $build->user_id;
    }

    public function delete(User $user, Build $build)
    {
        return $user->id === $build->user_id;
    }
}
