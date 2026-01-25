<?php

namespace App\Policies;

use App\Models\LifeSection;
use App\Models\User;

class LifeSectionPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, LifeSection $lifeSection): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, LifeSection $lifeSection): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, LifeSection $lifeSection): bool
    {
        return $user->role === 'admin';
    }
}
