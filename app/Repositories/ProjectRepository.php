<?php

namespace App\Repositories;

use App\Data\ProjectData;
use App\Enums\ProjectTypeEnum;
use App\Models\Project;

class ProjectRepository
{
    public function __construct(public Project $project)
    {
    }

    static public function store(ProjectData $data): Project
    {
        $project = Project::query()->create([
            'name' => $data->name,
            'description' => $data->description,
            'company_id' => $data->company_id,
            'type' => ProjectTypeEnum::from($data->type)
        ]);

        if ($project->isComplex()) {
            $project->complexDetails()->create([
                'budget' => $data->budget,
                'timeline' => $data->timeline
            ]);
        }

        return $project;
    }

    public function update(ProjectData $data): bool
    {
        $updated = $this->project->update([
            'name' => $data->name,
            'description' => $data->description,
            'company_id' => $data->company_id,
            'type' => $data->type
        ]);

        if ($this->project->isComplex()) {
            $this->project->complexDetails()->create([
                'budget' => $data->budget,
                'timeline' => $data->timeline
            ]);
        }

        return $updated;
    }

    public function destroy(): bool
    {
        return $this->project->delete();
    }
}
