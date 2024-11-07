<?php

namespace App\Http\Controllers;

use App\Data\UserData;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', User::class);

        return response()->json(UserData::collect(User::all()));
    }

    public function store(UserData $data)
    {
        Gate::authorize('create', User::class);

        return response()->json(UserData::from(UserRepository::store($data)), 201);
    }

    public function show(User $user)
    {
        Gate::authorize('view', User::class);

        return response()->json(UserData::from($user));
    }

    public function update(UserData $data, User $user)
    {
        Gate::authorize('update', User::class);

        return response()->json($user->repository()->update($data));
    }

    public function destroy(User $user)
    {
        Gate::authorize('delete', User::class);

        return response()->json($user->repository()->destroy());
    }
}
