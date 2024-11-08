<?php

namespace App\Repositories;

use App\Data\CompanyData;
use App\Data\UserData;
use App\Models\Company;
use App\Models\User;

class CompanyRepository
{
    public function __construct(public Company $company)
    {
    }

    static public function store(CompanyData $data): Company
    {
        return Company::query()->create([
            'name' => $data->name
        ]);
    }

    public function update(CompanyData $data): bool
    {
        return $this->company->update([
            'name' => $data->name
        ]);
    }

    public function destroy(): bool
    {
        return $this->company->delete();
    }

    public function assignUser(User $user): void
    {
        $this->company->users()->attach($user->id);
    }

    public function removeUser(User $user): void
    {
        $this->company->users()->detach($user->id);
    }
}
