<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        return $this->canUseOrders($user);
    }

    public function view(User $user, Order $order): bool
    {
        return $this->canUseOrders($user);
    }

    public function create(User $user): bool
    {
        return $this->canUseOrders($user);
    }

    public function update(User $user, Order $order): bool
    {
        return $user->isSuperAdmin();
    }

    public function delete(User $user, Order $order): bool
    {
        return $user->isSuperAdmin();
    }

    public function deleteAny(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    public function updateProgress(User $user, Order $order): bool
    {
        return $this->canUseOrders($user);
    }

    public function updatePayment(User $user, Order $order): bool
    {
        return $this->canUseOrders($user);
    }

    protected function canUseOrders(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdmin();
    }
}
