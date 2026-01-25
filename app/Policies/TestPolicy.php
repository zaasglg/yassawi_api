<?php

namespace App\Policies;

use App\Models\Test;
use App\Models\User;

class TestPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Test $test): bool
    {
        return true;
    }

    /**
     * Determine whether the user can submit the test.
     */
    public function submit(User $user, Test $test): bool
    {
        return in_array($user->role, ['student', 'admin']);
    }
}
