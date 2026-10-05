@extends('layouts.app')

@section('title', $project->title . ' — RESTORE')

@section('content')

<section class="min-h-screen">
    <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8">
        <a
            href="{{ route('projects.index') }}"
            class="text-sm text-[#77766F]">
            ← Back to projects
        </a>

        <h1 class="mt-8 text-5xl font-semibold">
            {{ $project->title }}
        </h1>

        @if ($project->short_description)
            <p class="mt-6 max-w-2xl text-lg leading-8 text-[#77766F]">
                {{ $project->short_description }}
            </p>
        @endif
    </div>
</section>
@endsection
