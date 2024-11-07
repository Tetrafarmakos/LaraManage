<?php

namespace App\Repositories;

use App\Data\ProjectData;
use App\Models\Project;

class ProjectRepository
{
    public function __construct(public Project $project)
    {
    }

    static public function store(ProjectData $data): Project
    {
        return Project::query()->create([
            'name' => $data->name,
            'description' => $data->description,
            'company_id' => $data->company_id,
            'type' => $data->type
        ]);
    }

    public function update(ProjectData $data): bool
    {
        return $this->project->update([
            'name' => $data->name,
            'description' => $data->description,
            'company_id' => $data->company_id,
            'type' => $data->type
        ]);
    }

    public function destroy(): bool
    {
        return $this->project->delete();
    }
}
