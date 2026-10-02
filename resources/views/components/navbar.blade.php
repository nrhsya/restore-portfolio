<header class="sticky top-0 z-50 border-b border-[#343532]/10 bg-[#F5F1E8]/90 backdrop-blur">
    <nav
        class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 lg:px-8"
        aria-label="Main navigation"
    >

        {{-- Logo --}}
        <a
            href="{{ route('home') }}"
            class="text-xl font-semibold tracking-tight"
        >
            RESTORE<span class="text-[#7F9473]">.</span>
        </a>

        {{-- Desktop navigation --}}
        <div class="hidden items-center gap-8 md:flex">

            <a
                href="#about"
                class="text-sm text-[#77766F] transition hover:text-[#343532]"
            >
                About
            </a>

            <a
                href="#projects"
                class="text-sm text-[#77766F] transition hover:text-[#343532]"
            >
                Projects
            </a>

            <a
                href="#experience"
                class="text-sm text-[#77766F] transition hover:text-[#343532]"
            >
                Experience
            </a>

            <a
                href="#skills"
                class="text-sm text-[#77766F] transition hover:text-[#343532]"
            >
                Skills
            </a>

            <a
                href="#contact"
                class="rounded-full bg-[#343532] px-5 py-2.5 text-sm text-white transition hover:bg-[#7F9473]"
            >
                Let's talk
            </a>

        </div>

        {{-- Mobile button --}}
        <button
            type="button"
            class="md:hidden"
            aria-label="Open navigation"
        >
            <svg
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
        </button>

    </nav>
</header>
