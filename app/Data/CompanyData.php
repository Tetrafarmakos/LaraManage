<?php

namespace App\Data;

use App\Models\Company;
use Illuminate\Support\Optional;
use Spatie\LaravelData\Data;

class CompanyData extends Data
{
    public function __construct(
        public ?string $id,
        public string  $name
    )
    {
    }

    public static function fromModel(Company $company): self
    {
        return new self(
            $company->id,
            $company->name
        );
    }

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:companies'],
        ];
    }
}
