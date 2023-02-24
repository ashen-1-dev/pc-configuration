<?php

namespace App\Models\User;

trait HasRoles
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole(string $role)
    {
        return $this->roles->contains('name', $role);
    }

    public function addRole(string $roleName)
    {
        $role = Role::where('name', $roleName)->firstOrFail();
        $this->roles()->syncWithoutDetaching([$role->id]);
        return $this;
    }

    public function addRoles(array $roleNames)
    {
        $role = Role::whereIn('name', $roleNames)->get('id');
        $this->roles()->syncWithoutDetaching($role->pluck('id'));
        return $this;
    }

    public function removeRole(string $roleName)
    {
        $role = Role::where('name', $roleName)->firstOrFail();
        $this->roles()->detach([$role->id]);
        return $this;
    }
}
