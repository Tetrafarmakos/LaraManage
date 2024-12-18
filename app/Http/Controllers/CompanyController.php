<?php

namespace App\Http\Controllers;

use App\Data\CompanyData;
use App\Models\Company;
use App\Models\User;
use App\Repositories\CompanyRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;

class CompanyController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        Gate::authorize('viewAny', Company::class);

        return response()->json(CompanyData::collect(Company::all()));
    }

    public function store(CompanyData $data)
    {
        Gate::authorize('create', Company::class);

        return response()->json(CompanyData::from(CompanyRepository::store($data)), 201);
    }

    public function show(Company $company)
    {
        Gate::authorize('view', $company);

        return response()->json(CompanyData::from($company)->include('projects'));
    }

    public function update(CompanyData $data, Company $company)
    {
        Gate::authorize('update', $company);

        return response()->json($company->repository()->update($data));
    }

    public function destroy(Company $company)
    {
        Gate::authorize('delete', $company);

        return response()->json($company->repository()->destroy());
    }

    public function assignUser(Company $company, User $user)
    {
        Gate::authorize('assign', Company::class);

        $company->repository()->assignUser($user);

        return response()->json(['message' => 'User assigned to company successfully.']);
    }

    public function removeUser(Company $company, User $user)
    {
        Gate::authorize('assign', Company::class);

        $company->repository()->removeUser($user);

        return response()->json(['message' => 'User removed from company successfully.']);
    }
}
