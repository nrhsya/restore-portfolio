@extends('layouts.app')

@section('title', $project->title . ' — RESTORE')

@section(
    'description',
    $project->short_description ?? 'A project built by Hasya.'
)

@section('content')

{{-- Project Hero --}}
<section class="bg-[#F5F1E8]">
    <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8 lg:py-28">

        {{-- Back --}}
        <a
            href="{{ route('projects.index') }}"
            class="inline-flex items-center gap-2 text-sm text-[#77766F] transition hover:text-[#343532]"
        >
            <span>←</span>
            <span>Back to projects</span>
        </a>

        <div class="mt-12 max-w-4xl">

            <p class="text-sm font-medium uppercase tracking-[0.2em] text-[#7F9473]">
                Project
            </p>

            <h1 class="mt-4 text-5xl font-semibold tracking-tight sm:text-6xl lg:text-7xl">
                {{ $project->title }}
            </h1>

            @if ($project->short_description)
                <p class="mt-6 max-w-3xl text-lg leading-8 text-[#77766F] sm:text-xl">
                    {{ $project->short_description }}
                </p>
            @endif

            {{-- Skills --}}
            @if ($project->skills->isNotEmpty())
                <div class="mt-8 flex flex-wrap gap-2">

                    @foreach ($project->skills as $skill)
                        <span class="rounded-full bg-[#FFFDF7] px-4 py-2 text-sm text-[#77766F]">
                            {{ $skill->name }}
                        </span>
                    @endforeach

                </div>
            @endif

            {{-- Links --}}
            @if ($project->live_url || $project->github_url)
                <div class="mt-10 flex flex-wrap gap-4">

                    @if ($project->live_url)
                        <a
                            href="{{ $project->live_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="rounded-full bg-[#343532] px-6 py-3 text-sm font-medium text-white transition hover:bg-[#7F9473]"
                        >
                            View live site ↗
                        </a>
                    @endif

                    @if ($project->github_url)
                        <a
                            href="{{ $project->github_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="rounded-full border border-[#343532]/20 px-6 py-3 text-sm font-medium transition hover:bg-[#FFFDF7]"
                        >
                            View source ↗
                        </a>
                    @endif

                </div>
            @endif

        </div>

    </div>
</section>


{{-- Main Image --}}
@if ($project->thumbnail)
    <section class="bg-[#F5F1E8] pb-24">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="overflow-hidden rounded-3xl bg-[#FFFDF7]">

                <img
                    src="{{ Storage::url($project->thumbnail->image) }}"
                    alt="{{ $project->title }}"
                    class="h-auto w-full object-cover"
                >

            </div>

        </div>

    </section>
@endif


{{-- Project Overview --}}
@if ($project->description)
    <section class="bg-[#FFFDF7]">

        <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8">

            <div class="grid gap-12 lg:grid-cols-3">

                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.2em] text-[#7F9473]">
                        Overview
                    </p>
                </div>

                <div class="min-w-0 lg:col-span-2">

                    <div
                        class="max-w-3xl break-words text-base leading-8 text-[#77766F]
                               [&_p]:mb-5
                               [&_h2]:mb-4
                               [&_h2]:mt-10
                               [&_h2]:text-2xl
                               [&_h2]:font-semibold
                               [&_h2]:text-[#343532]
                               [&_h3]:mb-3
                               [&_h3]:mt-8
                               [&_h3]:text-xl
                               [&_h3]:font-semibold
                               [&_h3]:text-[#343532]
                               [&_ul]:mb-5
                               [&_ul]:list-disc
                               [&_ul]:pl-6
                               [&_ol]:mb-5
                               [&_ol]:list-decimal
                               [&_ol]:pl-6
                               [&_a]:break-all
                               [&_a]:text-[#7F9473]
                               [&_a]:underline"
                    >
                        {!! $project->description !!}
                    </div>

                </div>

            </div>

        </div>

    </section>
@endif

{{-- Project Sections --}}
@if ($project->sections->isNotEmpty())
    <section class="bg-[#FFFDF7]">
        <div class="mx-auto max-w-7xl px-6 pb-24 lg:px-8">
            <div class="space-y-20">
                @foreach ($project->sections as $section)
                    <div class="grid gap-8 lg:grid-cols-3">
                        {{-- Section title --}}
                        <div>
                            <h2
                                class="text-sm font-medium uppercase tracking-[0.2em] text-[#7F9473]"
                            >
                                {{ $section->title }}
                            </h2>
                        </div>

                        {{-- Content --}}
                        <div class="min-w-0 lg:col-span-2">
                            <div
                                class="max-w-3xl wrap-break-word text-base leading-8 text-[#77766F]
                                       [&_p]:mb-5
                                       [&_strong]:font-semibold
                                       [&_strong]:text-[#343532]
                                       [&_h2]:mb-4
                                       [&_h2]:mt-8
                                       [&_h2]:text-2xl
                                       [&_h2]:font-semibold
                                       [&_h2]:text-[#343532]
                                       [&_h3]:mb-3
                                       [&_h3]:mt-6
                                       [&_h3]:text-xl
                                       [&_h3]:font-semibold
                                       [&_h3]:text-[#343532]
                                       [&_ul]:mb-5
                                       [&_ul]:list-disc
                                       [&_ul]:pl-6
                                       [&_ol]:mb-5
                                       [&_ol]:list-decimal
                                       [&_ol]:pl-6"
                            >
                                {!! $section->content !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

{{-- Project Gallery --}}
@if ($project->galleryImages->isNotEmpty())
    <section class="bg-[#F5F1E8]">

        <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8">

            <div class="max-w-2xl">

                <p class="text-sm font-medium uppercase tracking-[0.2em] text-[#7F9473]">
                    Gallery
                </p>

                <h2 class="mt-4 text-3xl font-semibold sm:text-4xl">
                    A closer look.
                </h2>

            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-2">

                @foreach ($project->galleryImages as $image)

                    <div class="overflow-hidden rounded-3xl bg-[#FFFDF7]">

                        <img
                            src="{{ Storage::url($image->image) }}"
                            alt="{{ $project->title }}"
                            loading="lazy"
                            class="h-auto w-full object-cover"
                        >

                    </div>

                @endforeach

            </div>

        </div>

    </section>
@endif


{{-- Project Navigation --}}
<section class="bg-[#343532] text-[#F5F1E8]">
    <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
        <div class="grid gap-10 md:grid-cols-2">
            {{-- Previous Project --}}
            <div>
                @if ($previousProject)
                    <a
                        href="{{ route('projects.show', $previousProject) }}"
                        class="group block"
                    >
                        <p class="text-sm text-[#A8B89A]">
                            ← Previous project
                        </p>

                        <h2
                            class="mt-3 text-2xl font-semibold transition group-hover:text-[#A8B89A]"
                        >
                            {{ $previousProject->title }}
                        </h2>
                    </a>
                @endif
            </div>


            {{-- Next Project --}}
            <div class="md:text-right">
                @if ($nextProject)
                    <a
                        href="{{ route('projects.show', $nextProject) }}"
                        class="group block"
                    >
                        <p class="text-sm text-[#A8B89A]">
                            Next project →
                        </p>

                        <h2
                            class="mt-3 text-2xl font-semibold transition group-hover:text-[#A8B89A]"
                        >
                            {{ $nextProject->title }}
                        </h2>
                    </a>
                @endif
            </div>
        </div>

        {{-- All Projects --}}
        <div class="mt-16 border-t border-white/10 pt-8 text-center">
            <a
                href="{{ route('projects.index') }}"
                class="text-sm text-[#F5F1E8]/70 transition hover:text-white"
            >
                View all projects
            </a>
        </div>
    </div>
</section>

@endsection
