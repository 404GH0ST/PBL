<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $this->isSuperAdmin($user);
    }

    public function view(User $user, User $model): bool
    {
        return $this->isSuperAdmin($user) && $this->isAdminAccount($model);
    }

    public function create(User $user): bool
    {
        return $this->isSuperAdmin($user);
    }

    public function update(User $user, User $model): bool
    {
        return $this->isSuperAdmin($user) && $this->isAdminAccount($model);
    }

    public function delete(User $user, User $model): bool
    {
        return $this->isSuperAdmin($user) && $this->isAdminAccount($model);
    }

    public function deleteAny(User $user): bool
    {
        return $this->isSuperAdmin($user);
    }

    protected function isSuperAdmin(User $user): bool
    {
        return $user->role?->role_kode === 'superAdmin';
    }

    protected function isAdminAccount(User $user): bool
    {
        return $user->role?->role_kode === 'admin';
    }
}
