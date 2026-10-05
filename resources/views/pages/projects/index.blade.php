@extends('layouts.app')

@section('title', 'Projects — RESTORE')

@section(
    'description',
    'A collection of projects, experiments, and web applications built by Hasya.'
)

@section('content')

<section class="min-h-screen bg-[#F5F1E8]">
    <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8">

        {{-- Page Header --}}
        <div class="max-w-2xl">
            <p class="text-sm font-medium uppercase tracking-[0.2em] text-[#7F9473]">
                Projects
            </p>

            <h1 class="mt-4 text-4xl font-semibold tracking-tight sm:text-5xl">
                Things I've built.
            </h1>

            <p class="mt-6 text-lg leading-8 text-[#77766F]">
                A collection of projects I've worked on,
                experimented with, and learned from.
            </p>
        </div>


        {{-- Projects --}}
        <div class="mt-16 grid gap-8 md:grid-cols-2">
            @forelse ($projects as $project)
                <a
                    href="{{ route('projects.show', $project) }}"
                    class="group block"
                >
                    <article
                        class="h-full overflow-hidden rounded-3xl border border-[#343532]/10 bg-[#FFFDF7] transition duration-300 group-hover:-translate-y-1 group-hover:shadow-lg"
                    >
                        {{-- Project Thumbnail --}}
                        @if ($project->thumbnail)
                            <div class="aspect-video overflow-hidden">
                                <img
                                    src="{{ Storage::url($project->thumbnail->image) }}"
                                    alt="{{ $project->title }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                >
                            </div>
                        @endif

                        {{-- Project Content --}}
                        <div class="p-8">
                            {{-- Skills --}}
                            @if ($project->skills->isNotEmpty())
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($project->skills->take(5) as $skill)
                                        <span
                                            class="rounded-full bg-[#F5F1E8] px-3 py-1 text-xs text-[#77766F]"
                                        >
                                            {{ $skill->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif


                            {{-- Project Information --}}
                            <div class="mt-6">
                                <h2 class="text-2xl font-semibold text-[#343532]">
                                    {{ $project->title }}
                                </h2>

                                @if ($project->short_description)
                                    <p class="mt-3 leading-7 text-[#77766F]">
                                        {{ $project->short_description }}
                                    </p>
                                @endif
                            </div>


                            {{-- View Project --}}
                            <div
                                class="mt-6 flex items-center gap-2 text-sm font-medium text-[#7F9473]"
                            >
                                <span>
                                    View project
                                </span>

                                <span
                                    class="transition-transform duration-300 group-hover:translate-x-1"
                                >
                                    →
                                </span>
                            </div>
                        </div>
                    </article>
                </a>
            @empty
                {{-- Empty State --}}
                <div
                    class="col-span-full rounded-3xl border border-dashed border-[#343532]/20 px-6 py-16 text-center"
                >
                    <p class="text-[#77766F]">
                        Nothing here yet — something is being restored.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
