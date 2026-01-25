<?php

namespace App\Policies;

use App\Models\Work;
use App\Models\User;

class WorkPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Work $work): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Work $work): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Work $work): bool
    {
        return $user->role === 'admin';
    }
}
