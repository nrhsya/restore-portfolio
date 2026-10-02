@extends('layouts.app')

@section('title', 'RESTORE — A little world built by Hasya')

@section('content')

    <section class="min-h-[80vh]">
        <div class="mx-auto flex max-w-6xl flex-col px-6 py-24">

            <p class="mb-6 text-sm font-medium uppercase tracking-[0.2em] text-[#7F9473]">
                Welcome to RESTORE
            </p>

            <h1 class="max-w-3xl font-serif text-5xl leading-tight md:text-7xl">
                A little world
                <br>
                built by Hasya.
            </h1>

            <p class="mt-8 max-w-xl text-lg leading-8 text-[#77766F]">
                I'm a web developer who enjoys building useful things,
                learning new technologies, and occasionally turning
                portfolio websites into little worlds.
            </p>

            <div class="mt-10 flex flex-wrap gap-4">

                <a
                    href="#projects"
                    class="rounded-full bg-[#7F9473] px-6 py-3 text-sm font-medium text-white transition hover:bg-[#718568]"
                >
                    Explore my work
                </a>

                <a
                    href="#about"
                    class="rounded-full border border-[#343532]/20 px-6 py-3 text-sm font-medium transition hover:bg-[#FFFDF7]"
                >
                    About me
                </a>

            </div>

        </div>
    </section>

@endsection
