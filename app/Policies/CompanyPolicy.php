<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): Response
    {
        return $user->can('manage users')
            ? Response::allow()
            : Response::deny('You do not have permission to view any users!');
    }

    public function view(User $user): Response
    {
        return $user->can('manage users')
            ? Response::allow()
            : Response::deny('You do not have permission to view a user!');
    }

    public function create(User $user): Response
    {
        return $user->can('manage users')
            ? Response::allow()
            : Response::deny('You do not have permission to create users!');
    }

    public function update(User $user): Response
    {
        return $user->can('manage users')
            ? Response::allow()
            : Response::deny('You do not have permission to update users!');
    }

    public function delete(User $user): Response
    {
        return $user->can('manage users')
            ? Response::allow()
            : Response::deny('You do not have permission to delete users!');
    }

    public function restore(User $user, User $model): Response
    {
        return Response::deny('You do not have permission to restore users!');
    }

    public function forceDelete(User $user, User $model): Response
    {
        return Response::deny('You do not have permission to force delete users!');
    }
}
