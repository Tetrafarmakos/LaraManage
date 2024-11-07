<?php

namespace App\Repositories;

use App\Data\CompanyData;
use App\Models\Company;

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
}
