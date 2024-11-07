<?php

namespace App\Http\Controllers;

use App\Data\ProjectData;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        Gate::authorize('viewAny', Project::class);

        return response()->json(ProjectData::collect(Project::all()));
    }

    public function store(ProjectData $data)
    {
        Gate::authorize('create', Project::class);

        return response()->json(ProjectData::from(ProjectRepository::store($data)), 201);
    }

    public function show(Project $project)
    {
        Gate::authorize('view', $project);

        return response()->json(ProjectData::from($project));
    }

    public function update(ProjectData $data, Project $project)
    {
        Gate::authorize('update', $project);

        return response()->json($project->repository()->update($data));
    }

    public function destroy(Project $project)
    {
        Gate::authorize('delete', $project);

        return response()->json($project->repository()->destroy());
    }
}
