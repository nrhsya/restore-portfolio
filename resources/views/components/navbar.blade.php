<header
    x-data="{ open: false }"
    class="sticky top-0 z-50 border-b border-[#343532]/10 bg-[#F5F1E8]/90 backdrop-blur"
>
    <nav
        class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 lg:px-8"
        aria-label="Main navigation">

        {{-- Logo --}}
        <a
            href="{{ route('home') }}"
            class="text-xl font-semibold tracking-tight"
        >
            RESTORE<span class="text-[#7F9473]">.</span>
        </a>

        {{-- Desktop navigation --}}
        <div class="hidden items-center gap-8 md:flex">
            <a href="{{ route('home') }}#about"
                class="text-sm text-[#77766F] transition hover:text-[#343532]">
                About
            </a>

            <a href="{{ route('home') }}#projects"
                class="text-sm text-[#77766F] transition hover:text-[#343532]">
                Projects
            </a>

            <a href="{{ route('home') }}#experience"
                class="text-sm text-[#77766F] transition hover:text-[#343532]">
                Experience
            </a>

            <a href="{{ route('home') }}#skills"
                class="text-sm text-[#77766F] transition hover:text-[#343532]">
                Skills
            </a>

            <a href="{{ route('home') }}#contact"
                class="rounded-full bg-[#343532] px-5 py-2.5 text-sm text-white transition hover:bg-[#7F9473]">
                Let's talk
            </a>
        </div>

        {{-- Mobile menu button --}}
        <button
            type="button"
            class="md:hidden"
            x-on:click="open = ! open"
            x-bind:aria-expanded="open"
            aria-label="Toggle navigation"
        >
            {{-- Hamburger --}}
            <svg
                x-show="! open"
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M4 6h16M4 12h16M4 18h16"
                />
            </svg>

            {{-- Close --}}
            <svg
                x-show="open"
                x-cloak
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>
    </nav>

    {{-- Mobile navigation --}}
    <div
        x-show="open"
        x-cloak
        x-transition
        class="border-t border-[#343532]/10 md:hidden"
    >
        <div class="flex flex-col px-6 py-6">
            <a href="{{ route('home') }}#about"
                x-on:click="open = false"
                class="border-b border-[#343532]/10 py-4">
                About
            </a>

            <a href="{{ route('home') }}#projects"
                x-on:click="open = false"
                class="border-b border-[#343532]/10 py-4">
                Projects
            </a>

            <a href="{{ route('home') }}#experience"
                x-on:click="open = false"
                class="border-b border-[#343532]/10 py-4">
                Experience
            </a>

            <a href="{{ route('home') }}#skills"
                x-on:click="open = false"
                class="border-b border-[#343532]/10 py-4">
                Skills
            </a>

            <a href="{{ route('home') }}#contact"
                x-on:click="open = false"
                class="py-4">
                Let's talk
            </a>
        </div>
    </div>
</header>
