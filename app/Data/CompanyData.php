<?php

namespace App\Data;

use App\Models\Company;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class CompanyData extends Data
{
    public function __construct(
        public ?string $id,
        public string  $name,
        /** @var array<ProjectData> */
        public Lazy|array $projects
    )
    {
    }

    public static function fromModel(Company $company): self
    {
        return new self(
            $company->id,
            $company->name,
            Lazy::create(fn() => ProjectData::collect($company->projects))
        );
    }

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:companies'],
        ];
    }
}
