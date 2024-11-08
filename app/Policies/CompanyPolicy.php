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
        return $user->can('manage companies')
            ? Response::allow()
            : Response::deny('You do not have permission to view any companies!');
    }

    public function view(User $user): Response
    {
        return $user->can('manage companies')
            ? Response::allow()
            : Response::deny('You do not have permission to view a company!');
    }

    public function create(User $user): Response
    {
        return $user->can('manage companies')
            ? Response::allow()
            : Response::deny('You do not have permission to create companies!');
    }

    public function update(User $user): Response
    {
        return $user->can('manage companies')
            ? Response::allow()
            : Response::deny('You do not have permission to update companies!');
    }

    public function delete(User $user): Response
    {
        return $user->can('manage companies')
            ? Response::allow()
            : Response::deny('You do not have permission to delete companies!');
    }

    public function restore(User $user, Company $model): Response
    {
        return Response::deny('You do not have permission to restore companies!');
    }

    public function forceDelete(User $user, Company $model): Response
    {
        return Response::deny('You do not have permission to force delete companies!');
    }

    public function assign(User $user): Response
    {
        return $user->can('manage companies')
            ? Response::allow()
            : Response::deny('You do not have permission to assign user to a company!');
    }
}
