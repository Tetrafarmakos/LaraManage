<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): Response
    {
        return $user->can('manage users')
            ? Response::allow()
            : Response::deny('You do not have permission to view any users!');
    }

    public function view(User $user, User $model): Response
    {
        return Response::deny('You do not have permission to view a user!');
    }

    public function create(User $user): Response
    {
        return Response::deny('You do not have permission to create users!');
    }

    public function update(User $user, User $model): Response
    {
        return Response::deny('You do not have permission to update users!');
    }

    public function delete(User $user, User $model): Response
    {
        return Response::deny('You do not have permission to delete users!');
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
