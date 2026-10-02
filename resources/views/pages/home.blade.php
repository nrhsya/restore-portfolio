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

            <div class="grid gap-12 lg:grid-cols-3">

                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.2em] text-[#7F9473]">
                        About me
                    </p>
                </div>

                <div class="lg:col-span-2">

                    <h2 class="max-w-3xl text-3xl font-semibold leading-tight sm:text-4xl">
                        I like building things that make complicated processes
                        feel a little simpler.
                    </h2>

                    <div class="mt-8 max-w-2xl space-y-5 text-base leading-7 text-[#77766F]">

                        <p>
                            I'm Hasya, a web developer working primarily with
                            Laravel and PHP to build web applications and
                            internal systems.
                        </p>

                        <p>
                            Outside of work, I enjoy experimenting with new
                            technologies, building little projects, and finding
                            increasingly unnecessary ways to make them more fun.
                        </p>

                    </div>

                </div>

            </div>

        </div>
    </section>

    {{-- Projects --}}
    <section
        id="projects"
        class="bg-[#F5F1E8]"
    >
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

                <a
                    href="#"
                    class="hidden text-sm font-medium md:block"
                >
                    View all projects →
                </a>

            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-2">

                {{-- Temporary project --}}
                <article class="rounded-3xl border border-[#343532]/10 bg-[#FFFDF7] p-8">

                    <div class="mb-16">
                        <span class="rounded-full bg-[#A8B89A]/30 px-3 py-1 text-xs">
                            Laravel
                        </span>
                    </div>

                    <h3 class="text-2xl font-semibold">
                        Project coming soon
                    </h3>

                    <p class="mt-3 text-[#77766F]">
                        This will soon be populated directly from the
                        portfolio backoffice.
                    </p>

                </article>

            </div>

        </div>
    </section>
@endsection
