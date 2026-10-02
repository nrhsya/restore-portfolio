<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::first();

        $projects = Project::query()
            ->with('thumbnail', 'skills')
            ->where('status', true)
            ->where('featured', true)
            ->latest()
            ->take(4)
            ->get();

        $experiences = Experience::query()
            ->latest('start_date')
            ->get();

        $skills = Skill::query()
            ->orderBy('name')
            ->get();

        return view('pages.home', compact(
            'profile',
            'projects',
            'experiences',
            'skills'
        ));
    }
}
