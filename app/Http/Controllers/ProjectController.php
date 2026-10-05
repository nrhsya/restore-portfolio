<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

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

    public function show(Project $project): View
    {
        // prevents users from accessing projects that are not published
        abort_unless($project->status, 404);

        $project->load([
            'thumbnail',
            'galleryImages',
            'skills',
            'sections',
        ]);

        $previousProject = Project::query()
            ->where('status', true)
            ->where('published_at', '<', $project->published_at)
            ->orderByDesc('published_at')
            ->first();

        $nextProject = Project::query()
            ->where('status', true)
            ->where('published_at', '>', $project->published_at)
            ->orderBy('published_at')
            ->first();

        return view('pages.projects.show', compact(
            'project',
            'previousProject',
            'nextProject',
        ));
    }
}
