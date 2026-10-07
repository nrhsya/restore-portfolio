@extends('layouts.app')

@section('title', 'RESTORE — A little world built by Hasya')

@section('content')

    {{-- Hero --}}
    <section class="relative overflow-hidden">

        <div class="mx-auto grid min-h-[85vh] max-w-7xl items-center gap-16 px-6 py-20 lg:grid-cols-2 lg:px-8">

            {{-- Hero content --}}
            <div>

                <div class="mb-6 flex items-center gap-3">
                    <span class="h-px w-8 bg-[#7F9473]"></span>

                    <span class="text-sm font-medium uppercase tracking-[0.2em] text-[#7F9473]">
                        Welcome to my little corner of the web
                    </span>
                </div>

                <h1 class="max-w-2xl text-5xl font-semibold leading-[1.1] tracking-tight sm:text-6xl lg:text-7xl">
                    A little world
                    <span class="text-[#7F9473]">built by Hasya.</span>
                </h1>

                <p class="mt-8 max-w-xl text-lg leading-8 text-[#77766F]">
                    I'm a web developer who enjoys turning complicated
                    problems into thoughtful web experiences — and
                    occasionally turning portfolio websites into little worlds.
                </p>

                <div class="mt-10 flex flex-wrap items-center gap-4">
                    <a
                        href="#projects"
                        class="rounded-full bg-[#343532] px-6 py-3 text-sm font-medium text-white transition hover:bg-[#7F9473]"
                    >
                        Explore my work
                    </a>

                    <a
                        href="#about"
                        class="rounded-full border border-[#343532]/20 px-6 py-3 text-sm font-medium transition hover:border-[#343532]/40 hover:bg-[#FFFDF7]"
                    >
                        More about me
                    </a>
                </div>
            </div>

            {{-- World preview --}}
            <div class="relative">
                <div class="aspect-square rounded-[3rem] border border-[#343532]/10 bg-[#FFFDF7] p-8 shadow-sm">
                    <div class="flex h-full items-center justify-center">
                        <div class="text-center">
                            <div class="text-7xl">
                                🌱
                            </div>

                            <p class="mt-6 text-sm font-medium">
                                Something is growing here...
                            </p>

                            <p class="mt-2 text-sm text-[#77766F]">
                                The world is still being restored.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Decorative element --}}
                <div class="absolute -bottom-6 -left-6 -z-10 h-40 w-40 rounded-full bg-[#A8B89A]/30"></div>

                <div class="absolute -right-10 -top-10 -z-10 h-56 w-56 rounded-full bg-[#D9A995]/20"></div>
            </div>
        </div>
    </section>

    {{-- About --}}
    <section
        id="about"
        class="bg-[#FFFDF7]"
    >
        <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8">
            @if ($profile)
                <div class="grid gap-12 lg:grid-cols-3">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-[0.2em] text-[#7F9473]">
                            About me
                        </p>
                    </div>

                    <div class="lg:col-span-2">
                        @if ($profile->short_bio)
                            <div>
                                <h2 class="max-w-3xl text-3xl font-semibold leading-tight sm:text-4xl">
                                    {!! $profile->short_bio !!}
                                </h2>
                            </div>
                        @endif

                        <div class="mt-8 max-w-2xl space-y-5 text-base leading-7 text-[#77766F]">
                            <div class="mt-8 max-w-2xl space-y-5 text-base leading-7 text-[#77766F]">
                                @if ($profile->bio)
                                    <div>
                                        <span>
                                            {!! $profile->bio !!}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- Projects --}}
    <section id="projects" class="bg-[#F5F1E8] scroll-mt-24">
        <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8">
            <div class="flex items-end justify-between gap-8">
                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.2em] text-[#7F9473]">
                        Selected work
                    </p>

                    <h2 class="mt-4 text-3xl font-semibold sm:text-4xl">
                        Things I've built.
                    </h2>
                </div>

                <a href="{{ route('projects.index') }}">
                    View all projects →
                </a>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-2">
                <div class="mt-12 grid gap-6 md:grid-cols-2">
                    @forelse ($projects as $project)
                        <article
                            class="group rounded-3xl border border-[#343532]/10 bg-[#FFFDF7] p-8 transition hover:-translate-y-1 hover:shadow-lg"
                        >
                            @if ($project->thumbnail)
                                <div class="mb-8 aspect-video overflow-hidden rounded-2xl">
                                    <img
                                        src="{{ Storage::url($project->thumbnail->image) }}"
                                        alt="{{ $project->title }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                    >
                                </div>
                            @endif
                            <div class="mb-16 flex items-center justify-between">
                                <span class="rounded-full bg-[#A8B89A]/30 px-3 py-1 text-xs">
                                    Project
                                </span>

                                <a href="{{ route('projects.show', ['project' => $project->slug]) }}">
                                    <span class="text-[#77766F] transition group-hover:translate-x-1">
                                        →
                                    </span>
                                </a>
                            </div>

                            <h3 class="text-2xl font-semibold">
                                {{ $project->title }}
                            </h3>

                            @if ($project->short_description)
                                <p class="mt-3 leading-7 text-[#77766F]">
                                    {{ $project->short_description }}
                                </p>
                            @endif

                            @if ($project->skills->isNotEmpty())
                                <div class="mt-6 flex flex-wrap gap-2">
                                    @foreach ($project->skills->take(5) as $skill)
                                        <span
                                            class="rounded-full bg-[#F5F1E8] px-3 py-1 text-xs text-[#77766F]"
                                        >
                                            {{ $skill->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </article>
                    @empty
                        <div class="rounded-3xl border border-dashed border-[#343532]/20 p-10 text-center">
                            <p class="text-[#77766F]">
                                Something is being built here...
                            </p>

                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    {{-- Experience --}}
    <section id="experience" class="bg-[#FFFDF7] scroll-mt-24">
        <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-3">
                {{-- Section heading --}}
                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.2em] text-[#7F9473]">Experience</p>

                    <h2 class="mt-4 text-3xl font-semibold">
                        Where I've worked.
                    </h2>
                </div>

                {{-- Experience list --}}
                <div class="lg:col-span-2">
                    @forelse ($experiences as $experience)
                        <article
                            class="border-b border-[#343532]/10 py-8 first:pt-0"
                        >
                            <div
                                class="flex flex-col justify-between gap-4 sm:flex-row"
                            >
                                <div>
                                    <h3 class="text-xl font-semibold">
                                        {{ $experience->position }}
                                    </h3>

                                    <p class="mt-1 text-[#77766F]">
                                        {{ $experience->company }}
                                    </p>
                                </div>
                                <div class="shrink-0 text-sm text-[#77766F]">
                                    {{ $experience->start_date->format('M Y') }}
                                    —
                                    {{ $experience->end_date?->format('M Y') ?? 'Present' }}
                                </div>
                            </div>

                            @if ($experience->description)
                                <div
                                    class="mt-5 max-w-2xl leading-7 text-[#77766F]"
                                >
                                    {!! $experience->description !!}
                                </div>
                            @endif
                        </article>
                    @empty
                        <p class="text-[#77766F]">
                            Experience is being added.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    {{-- Skills --}}
    <section id="skills" class="bg-[#F5F1E8] scroll-mt-24">
        <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8">
            <div class="max-w-2xl">
                <p
                    class="text-sm font-medium uppercase tracking-[0.2em] text-[#7F9473]"
                >
                    Toolkit
                </p>

                <h2 class="mt-4 text-3xl font-semibold sm:text-4xl">
                    Things I build with.
                </h2>

                <p class="mt-5 leading-7 text-[#77766F]">
                    Technologies and tools I've worked with across
                    different projects.
                </p>
            </div>

            <div class="mt-12 flex flex-wrap gap-3">
                @forelse ($skills as $skill)
                    <span
                        class="rounded-full border border-[#343532]/10 bg-[#FFFDF7] px-5 py-3 text-sm transition hover:-translate-y-1 hover:border-[#7F9473]"
                    >
                        {{ $skill->name }}
                    </span>
                @empty
                    <p class="text-[#77766F]">
                        Skills are being added.
                    </p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Services --}}
    @if ($services->isNotEmpty())
        <section id="services" class="scroll-mt-24 bg-[#FFFDF7]">
            <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8">
                {{-- Section Header --}}
                <div class="max-w-2xl">
                    <p class="text-sm font-medium uppercase tracking-[0.2em] text-[#7F9473]">
                        Services
                    </p>

                    <h2 class="mt-4 text-3xl font-semibold tracking-tight sm:text-4xl">
                        How I can help.
                    </h2>

                    <p class="mt-5 leading-7 text-[#77766F]">
                        A few ways I can help turn ideas, improvements,
                        and technical requirements into working web experiences.
                    </p>
                </div>

                {{-- Service Cards --}}
                <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($services as $service)
                        <article
                            class="group flex h-full flex-col rounded-3xl border border-[#343532]/10 bg-[#F5F1E8] p-8 transition duration-300 hover:-translate-y-1 hover:shadow-lg"
                        >
                            {{-- Number --}}
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-[#A8B89A]/20 text-sm font-medium text-[#7F9473]"
                            >
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </div>

                            {{-- Service Information --}}
                            <div class="mt-8">
                                <h3 class="text-xl font-semibold text-[#343532]">
                                    {{ $service->title }}
                                </h3>

                                <div
                                    class="mt-4 wrap-break-word leading-7 text-[#77766F]
                                        [&_p]:mb-4
                                        [&_p:last-child]:mb-0
                                        [&_ul]:list-disc
                                        [&_ul]:pl-5
                                        [&_ol]:list-decimal
                                        [&_ol]:pl-5
                                        [&_a]:break-all
                                        [&_a]:text-[#7F9473]
                                        [&_a]:underline"
                                >
                                    {!! $service->description !!}
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Contact --}}
    <section id="contact" class="scroll-mt-24 bg-[#FFFDF7]">
        <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8">
            <div class="grid gap-16 lg:grid-cols-2">
                {{-- Introduction --}}
                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.2em] text-[#7F9473]">
                        Contact
                    </p>

                    <h2 class="mt-4 max-w-lg text-4xl font-semibold leading-tight sm:text-5xl">
                        Have something in mind?
                    </h2>

                    <p class="mt-6 max-w-lg leading-7 text-[#77766F]">
                        Whether it's a project, collaboration, opportunity,
                        or you just want to say hello — feel free to leave
                        me a message.
                    </p>
                </div>

                {{-- Form --}}
                <div>
                    @if (session('success'))
                        <div class="mb-8 rounded-2xl border border-[#7F9473]/30 bg-[#A8B89A]/20 p-5">
                            <p class="text-sm text-[#343532]">
                                {{ session('success') }}
                            </p>
                        </div>
                    @endif
                    <form
                        action="{{ route('contact.store') }}"
                        method="POST"
                        class="space-y-6">

                        @csrf

                        {{-- Name --}}
                        <div>
                            <label
                                for="name"
                                class="mb-2 block text-sm font-medium">
                                Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                class="w-full rounded-2xl border border-[#343532]/15 bg-[#F5F1E8] px-5 py-4 outline-none transition focus:border-[#7F9473]"
                                placeholder="Your name">

                            @error('name')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label
                                for="email"
                                class="mb-2 block text-sm font-medium">
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                class="w-full rounded-2xl border border-[#343532]/15 bg-[#F5F1E8] px-5 py-4 outline-none transition focus:border-[#7F9473]"
                                placeholder="you@example.com">

                            @error('email')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Subject --}}
                        <div>
                            <label
                                for="subject"
                                class="mb-2 block text-sm font-medium">
                                Subject
                                <span class="text-[#77766F]">
                                    (optional)
                                </span>
                            </label>

                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                value="{{ old('subject') }}"
                                class="w-full rounded-2xl border border-[#343532]/15 bg-[#F5F1E8] px-5 py-4 outline-none transition focus:border-[#7F9473]"
                                placeholder="What would you like to talk about?">

                            @error('subject')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Message --}}
                        <div>
                            <label
                                for="message"
                                class="mb-2 block text-sm font-medium">
                                Message
                            </label>

                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                required
                                class="w-full resize-none rounded-2xl border border-[#343532]/15 bg-[#F5F1E8] px-5 py-4 outline-none transition focus:border-[#7F9473]"
                                placeholder="Tell me a little about what you have in mind...">
                                {{ old('message') }}
                            </textarea>

                            @error('message')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="rounded-full bg-[#343532] px-7 py-3.5 text-sm font-medium text-white transition hover:bg-[#7F9473]">
                            Send message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
