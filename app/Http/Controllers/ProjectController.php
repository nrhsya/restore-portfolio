<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::query()
            ->with([
                'thumbnail',
                'skills',
            ])
            ->where('status', true)
            ->latest()
            ->get();

        return view('pages.projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        // prevents users from accessing projects that are not published
        abort_unless($project->status, 404);

        $project->load([
            'thumbnail',
            'skills',
            'galleryImages',
        ]);

        return view('pages.projects.show', compact('project'));
    }
}
