<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): Response
    {
        return $user->can('manage projects')
            ? Response::allow()
            : Response::deny('You do not have permission to view any projects!');
    }

    public function view(User $user): Response
    {
        return $user->can('manage projects')
            ? Response::allow()
            : Response::deny('You do not have permission to view a project!');
    }

    public function create(User $user): Response
    {
        return $user->can('manage projects')
            ? Response::allow()
            : Response::deny('You do not have permission to create projects!');
    }

    public function update(User $user): Response
    {
        return $user->can('manage projects')
            ? Response::allow()
            : Response::deny('You do not have permission to update projects!');
    }

    public function delete(User $user): Response
    {
        return $user->can('manage projects')
            ? Response::allow()
            : Response::deny('You do not have permission to delete projects!');
    }

    public function restore(User $user, Project $model): Response
    {
        return Response::deny('You do not have permission to restore projects!');
    }

    public function forceDelete(User $user, Project $model): Response
    {
        return Response::deny('You do not have permission to force delete projects!');
    }
}
