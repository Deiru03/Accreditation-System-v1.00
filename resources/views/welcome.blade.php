<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Welcome to the teacher accreditation system. Streamline your professional certification process with our comprehensive tools and resources.">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Tailwind CSS fallback styles here */
            </style>
        @endif
    </head>
    <body class="bg-[#F5F7FA] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4" aria-label="Main Navigation">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 border-[#3B82F6] hover:border-[#2563EB] border text-[#1b1b18] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 text-[#1b1b18] border border-transparent hover:border-[#3B82F6] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 border-[#3B82F6] hover:border-[#2563EB] border text-[#1b1b18] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row" aria-label="Welcome Content">
                <section class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white text-[#1b1b18] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                    <h1 class="mb-1 font-medium text-xl text-[#3B82F6]">{{ config('app.name', 'Teacher Accreditation Portal') }}</h1>
                    <p class="mb-4 text-[#4B5563]">Welcome to the teacher accreditation system. Streamline your professional certification process with our comprehensive tools and resources.</p>
                    
                    <h2 class="mb-2 font-medium text-[#3B82F6]">Key Features</h2>
                    <ul class="flex flex-col mb-6 lg:mb-8">
                        <li class="flex items-center gap-4 py-2 relative before:border-l before:border-[#3B82F6] before:top-1/2 before:bottom-0 before:left-[0.4rem] before:absolute">
                            <span class="relative py-1 bg-white">
                                <span class="flex items-center justify-center rounded-full bg-[#EFF6FF] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] w-3.5 h-3.5 border border-[#3B82F6]">
                                    <span class="rounded-full bg-[#3B82F6] w-1.5 h-1.5"></span>
                                </span>
                            </span>
                            <span>Track your certification progress</span>
                        </li>
                        <li class="flex items-center gap-4 py-2 relative before:border-l before:border-[#3B82F6] before:bottom-1/2 before:top-0 before:left-[0.4rem] before:absolute">
                            <span class="relative py-1 bg-white">
                                <span class="flex items-center justify-center rounded-full bg-[#EFF6FF] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] w-3.5 h-3.5 border border-[#3B82F6]">
                                    <span class="rounded-full bg-[#3B82F6] w-1.5 h-1.5"></span>
                                </span>
                            </span>
                            <span>Submit and manage documentation</span>
                        </li>
                        <li class="flex items-center gap-4 py-2 relative before:border-l before:border-[#3B82F6] before:bottom-1/2 before:top-0 before:left-[0.4rem] before:absolute">
                            <span class="relative py-1 bg-white">
                                <span class="flex items-center justify-center rounded-full bg-[#EFF6FF] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] w-3.5 h-3.5 border border-[#3B82F6]">
                                    <span class="rounded-full bg-[#3B82F6] w-1.5 h-1.5"></span>
                                </span>
                            </span>
                            <span>Access professional development resources</span>
                        </li>
                    </ul>
                    <h2 class="mb-2 font-medium text-[#3B82F6]">Resources</h2>
                    <ul class="flex flex-col mb-6">
                        <li class="flex items-center gap-4 py-2">
                            <a href="#" target="_blank" rel="noopener" class="inline-flex items-center space-x-1 font-medium underline underline-offset-4 text-[#3B82F6]">
                                <span>Accreditation Guidelines</span>
                                <svg
                                    width="10"
                                    height="11"
                                    viewBox="0 0 10 11"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-2.5 h-2.5"
                                    aria-hidden="true"
                                    focusable="false"
                                >
                                    <path
                                        d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001"
                                        stroke="currentColor"
                                        stroke-linecap="square"
                                    />
                                </svg>
                            </a>
                        </li>
                        <li class="flex items-center gap-4 py-2">
                            <a href="#" target="_blank" rel="noopener" class="inline-flex items-center space-x-1 font-medium underline underline-offset-4 text-[#3B82F6]">
                                <span>Professional Standards</span>
                                <svg
                                    width="10"
                                    height="11"
                                    viewBox="0 0 10 11"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-2.5 h-2.5"
                                    aria-hidden="true"
                                    focusable="false"
                                >
                                    <path
                                        d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001"
                                        stroke="currentColor"
                                        stroke-linecap="square"
                                    />
                                </svg>
                            </a>
                        </li>
                        <li class="flex items-center gap-4 py-2">
                            <a href="#" target="_blank" rel="noopener" class="inline-flex items-center space-x-1 font-medium underline underline-offset-4 text-[#3B82F6]">
                                <span>FAQ</span>
                                <svg
                                    width="10"
                                    height="11"
                                    viewBox="0 0 10 11"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-2.5 h-2.5"
                                    aria-hidden="true"
                                    focusable="false"
                                >
                                    <path
                                        d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001"
                                        stroke="currentColor"
                                        stroke-linecap="square"
                                    />
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <ul class="flex gap-3 text-sm leading-normal">
                        <li>
                            <a href="{{ route('register') }}" class="inline-block hover:bg-[#2563EB] hover:border-[#2563EB] px-5 py-1.5 bg-[#3B82F6] rounded-sm border border-[#3B82F6] text-white text-sm leading-normal">
                                Get Started
                            </a>
                        </li>
                        <li>
                            <a href="#" class="inline-block px-5 py-1.5 border border-[#3B82F6] text-[#3B82F6] rounded-sm text-sm leading-normal">
                                Learn More
                            </a>
                        </li>
                    </ul>
                </section>
                <aside class="bg-[#EFF6FF] relative lg:-ml-px -mb-px lg:mb-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg aspect-[335/376] lg:aspect-auto w-full lg:w-[438px] shrink-0 overflow-hidden" aria-label="Illustration">
                    <div class="flex items-center justify-center h-full p-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-48 h-48 text-[#3B82F6]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" aria-label="Education Icon">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                            <path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"/>
                            <path d="M22 10v6"/>
                            <circle cx="22" cy="19" r="2"/>
                        </svg>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-8 bg-gradient-to-t from-[#3B82F6]/40 to-transparent">
                        <div class="text-center">
                            <h2 class="text-xl font-semibold text-white mb-2">Teacher Accreditation</h2>
                            <p class="text-white/90">Advancing education through professional excellence</p>
                        </div>
                    </div>
                    <div class="absolute inset-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg shadow-[inset_0px_0px_0px_1px_rgba(59,130,246,0.5)]"></div>
                </aside>
            </main>
        </div>
        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
        <footer class="w-full text-center text-xs text-[#A1A09A] mt-8">
            &copy; {{ date('Y') }} {{ config('app.name', 'Teacher Accreditation Portal') }}. All rights reserved.
        </footer>
    </body>
</html>
