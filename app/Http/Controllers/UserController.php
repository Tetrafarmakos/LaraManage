<?php

namespace App\Http\Controllers;

use App\Data\UserData;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', User::class);

        return User::all();
    }

    public function store(UserData $data)
    {
        Gate::authorize('create', User::class);

        return UserRepository::store($data);
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
