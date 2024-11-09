<?php

namespace App\Data;

use App\Models\Project;
use DateTime;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Data;

class ProjectData extends Data
{
    public function __construct(
        public ?string   $id,
        public string    $name,
        public string    $description,
        public string    $company_id,
        public string    $type,
        public ?float    $budget,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d')]
        public ?DateTime $timeline
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
            $project->type,
            $project->complexDetails?->budget,
            $project->complexDetails?->timeline
        );
    }

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:projects', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'company_id' => ['required', 'exists:companies,id'],
            'type' => ['required', 'string'],
            'budget' => ['required_if:type,complex', 'max:1000000', 'numeric'],
            'timeline' => ['required_if:type,complex', 'max:225', 'date'],
        ];
    }
}
