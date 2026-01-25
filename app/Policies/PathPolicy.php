<?php

namespace App\Policies;

use App\Models\Path;
use App\Models\User;

class PathPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Path $path): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Path $path): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Path $path): bool
    {
        return $user->role === 'admin';
    }
}
