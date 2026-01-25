<?php

namespace App\Policies;

use App\Models\Study;
use App\Models\User;

class StudyPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Study $study): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Study $study): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Study $study): bool
    {
        return $user->role === 'admin';
    }
}
