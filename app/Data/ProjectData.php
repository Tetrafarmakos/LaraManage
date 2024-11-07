<?php

namespace App\Data;

use App\Models\Company;
use App\Models\Project;
use Illuminate\Support\Optional;
use Spatie\LaravelData\Data;

class ProjectData extends Data
{
    public function __construct(
        public ?string $id,
        public string  $name,
        public string  $description,
        public string  $company_id,
        public string  $type
    )
    {
    }

    public static function fromModel(Project $project): self
    {
        return new self(
            $project->id,
            $project->name,
            $project->description,
            $project->company_id,
            $project->type
        );
    }

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:projects'],
            'description' => ['required', 'string'],
            'company_id' => ['required', 'exists:companies,id'],
            'type' => ['required', 'string']
        ];
    }
}
