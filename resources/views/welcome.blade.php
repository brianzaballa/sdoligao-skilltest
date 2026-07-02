<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="fi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="DepEd Ligao City Division Finance Management Portal — Procurement, Budget, and Financial Transparency">
    <title>DepEd Ligao City — Finance Management Portal</title>

    @fonts

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'] },
                        colors: {
                            deped: { 50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd', 400: '#60a5fa', 500: '#2563eb', 600: '#1d4ed8', 700: '#1e40af', 800: '#1e3a8a', 900: '#172554' },
                            sdo: { 50: '#f0fdf4', 100: '#dcfce7', 200: '#bbf7d0', 300: '#86efac', 400: '#4ade80', 500: '#22c55e', 600: '#16a34a', 700: '#15803d', 800: '#166534', 900: '#14532d' }
                        }
                    }
                },
            }
        </script>
    @endif

    <style>
        [x-cloak] { display: none !important; }
        .fi { --sidebar-width: 20rem; --collapsed-sidebar-width: 5.4rem; }
    </style>

    <script>
        const loadDarkMode = () => {
            window.theme = localStorage.getItem('theme') ?? 'system'
            if (window.theme === 'dark' || (window.theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }
        }
        loadDarkMode()
    </script>
</head>
<body class="fi-body min-h-screen bg-gray-50 dark:bg-gray-950 text-gray-950 dark:text-white font-sans antialiased">
    <div x-data="{
        theme: localStorage.getItem('theme') ?? 'system',
        themes: ['light', 'dark', 'system'],
        mobileOpen: false,
        init() {
            this.$watch('theme', () => {
                localStorage.setItem('theme', this.theme)
                if (this.theme === 'dark' || (this.theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark')
                } else {
                    document.documentElement.classList.remove('dark')
                }
            })
        }
    }" class="flex flex-col min-h-screen">

        {{-- Navigation --}}
        <nav class="sticky top-0 z-50 bg-white dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-14">
                    <a href="/" class="flex items-center gap-3">
                        <div class="flex items-center gap-2.5">
                            <img src="{{ asset('images/ligao-logo.png') }}" alt="SDO Ligao City" class="w-8 h-8 object-contain">
                            <div>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">Finance Management Portal</span>
                                <p class="text-[10px] leading-tight text-gray-500 dark:text-gray-400 hidden sm:block">DepEd SDO Ligao City</p>
                            </div>
                        </div>
                    </a>

                    <div class="hidden md:flex items-center gap-1">
                        <a href="/" class="px-3 py-1.5 text-sm font-medium text-deped-600 dark:text-deped-400">Home</a>
                        <a href="#procurement" class="px-3 py-1.5 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">Procurement</a>
                        <a href="#budget" class="px-3 py-1.5 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">Budget</a>
                        <a href="{{ route('issuances') }}" class="px-3 py-1.5 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">Issuances</a>
                        <a href="{{ route('bac-matters') }}" class="px-3 py-1.5 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">BAC Matters</a>
                        <a href="{{ route('transparency-seal') }}" class="px-3 py-1.5 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">Transparency</a>

                        <div class="w-px h-4 bg-gray-200 dark:bg-gray-800 mx-2"></div>

                        <div class="flex items-center rounded-lg border border-gray-200 dark:border-gray-800 overflow-hidden">
                            <template x-for="t in themes" :key="t">
                                <button
                                    x-on:click="theme = t"
                                    x-bind:class="{ 'bg-deped-100 dark:bg-deped-900/30 text-deped-600 dark:text-deped-400': theme === t, 'text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300': theme !== t }"
                                    class="p-1.5 transition" type="button"
                                    x-bind:aria-label="'Switch to ' + t + ' mode'"
                                >
                                    <template x-if="t === 'light'"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg></template>
                                    <template x-if="t === 'dark'"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg></template>
                                    <template x-if="t === 'system'"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></template>
                                </button>
                            </template>
                        </div>

                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/admin') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-sm font-medium text-white bg-deped-600 hover:bg-deped-700 rounded-lg shadow-sm transition ml-2">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-sm font-medium text-white bg-deped-600 hover:bg-deped-700 rounded-lg shadow-sm transition ml-2">
                                    Log in
                                </a>
                            @endauth
                        @endif
                    </div>

                    <div class="flex md:hidden items-center gap-2">
                        <div class="flex items-center rounded-lg border border-gray-200 dark:border-gray-800 overflow-hidden">
                            <template x-for="t in themes" :key="t">
                                <button
                                    x-on:click="theme = t"
                                    x-bind:class="{ 'bg-deped-100 dark:bg-deped-900/30 text-deped-600 dark:text-deped-400': theme === t, 'text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300': theme !== t }"
                                    class="p-1.5 transition" type="button"
                                    x-bind:aria-label="'Switch to ' + t + ' mode'"
                                >
                                    <template x-if="t === 'light'"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg></template>
                                    <template x-if="t === 'dark'"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg></template>
                                    <template x-if="t === 'system'"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></template>
                                </button>
                            </template>
                        </div>
                        <button x-on:click="mobileOpen = !mobileOpen" type="button" class="p-2 -mr-2 text-gray-600 dark:text-gray-400 hover:text-gray-950 dark:hover:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition" aria-label="Toggle menu">
                            <svg x-show="!mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            <svg x-show="mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>

                <div x-cloak x-show="mobileOpen" x-collapse class="md:hidden border-t border-gray-200 dark:border-gray-800 py-2 space-y-1">
                    <a href="/" x-on:click="mobileOpen = false" class="block px-3 py-2 text-sm font-medium text-deped-600 dark:text-deped-400">Home</a>
                    <a href="#procurement" x-on:click="mobileOpen = false" class="block px-3 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition">Procurement</a>
                    <a href="#budget" x-on:click="mobileOpen = false" class="block px-3 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition">Budget</a>
                    <a href="{{ route('issuances') }}" x-on:click="mobileOpen = false" class="block px-3 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition">Issuances</a>
                    <a href="{{ route('bac-matters') }}" x-on:click="mobileOpen = false" class="block px-3 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition">BAC Matters</a>
                    <a href="{{ route('transparency-seal') }}" x-on:click="mobileOpen = false" class="block px-3 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition">Transparency</a>
                    <div class="pt-2 border-t border-gray-200 dark:border-gray-800">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/admin') }}" class="flex items-center justify-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-deped-600 hover:bg-deped-700 rounded-lg shadow-sm transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="flex items-center justify-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-deped-600 hover:bg-deped-700 rounded-lg shadow-sm transition">Log in</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-1">
            {{-- Hero --}}
            <section class="relative bg-white dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800 overflow-hidden">
                {{-- Subtle background grid --}}
                <div class="absolute inset-0 bg-[linear-gradient(to_right,#e5e7eb_1px,transparent_1px),linear-gradient(to_bottom,#e5e7eb_1px,transparent_1px)] dark:bg-[linear-gradient(to_right,#1f2937_1px,transparent_1px),linear-gradient(to_bottom,#1f2937_1px,transparent_1px)] bg-[size:3rem_3rem] opacity-40 pointer-events-none"></div>
                {{-- Radial fade over the grid --}}
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_60%_at_50%_0%,rgba(255,255,255,0.9)_40%,transparent_100%)] dark:bg-[radial-gradient(ellipse_80%_60%_at_50%_0%,rgba(3,7,18,0.9)_40%,transparent_100%)] pointer-events-none"></div>

                <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-28">
                    <div class="max-w-3xl mx-auto text-center">
                        {{-- Eyebrow badge --}}
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-deped-50 dark:bg-deped-900/20 text-deped-600 dark:text-deped-400 text-[11px] font-medium mb-8 border border-deped-100 dark:border-deped-800/50 tracking-wide">
                            <img src="{{ asset('images/ligao-logo.png') }}" alt="" class="w-4 h-4 object-contain">
                            Republic of the Philippines &bull; DepEd Region V &bull; SDO Ligao City
                        </div>

                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-gray-900 dark:text-white leading-[1.1]">
                            Empowering Education<br class="hidden sm:block">
                            <span class="text-deped-600 dark:text-deped-400">Through Transparent</span><br class="hidden sm:block">
                            Fiscal Management
                        </h1>

                        <p class="mt-6 text-base sm:text-lg text-gray-500 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                            Every peso allocated to Ligao City schools, tracked from budget release to liquidation — in one portal open to the offices, schools, and communities it serves.
                        </p>

                        <div class="mt-10 flex flex-col items-center gap-4">
                            {{-- Primary CTA row --}}
                            <div class="flex flex-wrap items-center justify-center gap-3">
                                @if (Route::has('login'))
                                    @auth
                                    <a href="{{ url('/admin') }}" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white bg-deped-600 hover:bg-deped-700 rounded-xl shadow-sm transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                        Go to my Portal
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white bg-deped-600 hover:bg-deped-700 rounded-xl shadow-sm transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                        Sign In to Portal
                                    </a>
                                @endauth
                                @endif
                                @auth
                                    <a href="{{ url('/admin') }}" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 hover:border-deped-300 dark:hover:border-deped-700 rounded-xl shadow-sm transition">
                                        Go to my Portal
                                    </a>
                                @else
                                    <a href="{{ url('/admin') }}" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 hover:border-deped-300 dark:hover:border-deped-700 rounded-xl shadow-sm transition">
                                        Access Portal
                                    </a>
                                @endauth
                            </div>

                            {{-- Who can sign in --}}
                            @guest
                                <div class="flex flex-wrap items-center justify-center gap-2 text-[11px] text-gray-400 dark:text-gray-500">
                                    <span>Portal access for:</span>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 font-medium">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        SDO Personnel
                                    </span>
                                    <span class="text-gray-300 dark:text-gray-700">&bull;</span>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 font-medium">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        School Heads
                                    </span>
                                    <span class="text-gray-300 dark:text-gray-700">&bull;</span>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 font-medium">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                        Suppliers
                                    </span>
                                </div>
                            @endguest
                        </div>

                        {{-- Trust indicators --}}
                        <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-800 flex flex-wrap items-center justify-center gap-6 text-xs text-gray-400 dark:text-gray-500">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-sdo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                RA 11032 Compliant
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-sdo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                Transparency Seal Holder
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-sdo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                RA 9184 Procurement
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-sdo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                COA Audited
                            </span>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Quick Stats --}}
            <section class="bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-800">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-5 text-center">
                            <div class="text-2xl font-bold text-deped-600 dark:text-deped-400">&#x20B1;48.2M</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Total Budget FY 2025</div>
                        </div>
                        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-5 text-center">
                            <div class="text-2xl font-bold text-sdo-600 dark:text-sdo-400">67%</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Obligation Rate</div>
                        </div>
                        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-5 text-center">
                            <div class="text-2xl font-bold text-deped-600 dark:text-deped-400">12</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Active Procurement</div>
                        </div>
                        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-5 text-center">
                            <div class="text-2xl font-bold text-sdo-600 dark:text-sdo-400">38</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Serving Schools</div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Finance Quick Links --}}
            <section class="bg-gray-50 dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex flex-wrap items-center justify-center gap-2">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mr-1">Financial Tools:</span>
                        <a href="#procurement" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-300 hover:border-deped-200 dark:hover:border-deped-800 hover:text-deped-600 dark:hover:text-deped-400 text-xs font-medium shadow-sm transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            Procurement
                        </a>
                        <a href="#budget" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-300 hover:border-deped-200 dark:hover:border-deped-800 hover:text-deped-600 dark:hover:text-deped-400 text-xs font-medium shadow-sm transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Budget Allocation
                        </a>
                        <a href="{{ route('bac-matters') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-300 hover:border-deped-200 dark:hover:border-deped-800 hover:text-deped-600 dark:hover:text-deped-400 text-xs font-medium shadow-sm transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                            BAC Matters
                        </a>
                        <a href="{{ route('transparency-seal') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-300 hover:border-deped-200 dark:hover:border-deped-800 hover:text-deped-600 dark:hover:text-deped-400 text-xs font-medium shadow-sm transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Transparency
                        </a>
                        <a href="{{ route('issuances') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-300 hover:border-deped-200 dark:hover:border-deped-800 hover:text-deped-600 dark:hover:text-deped-400 text-xs font-medium shadow-sm transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Issuances
                        </a>
                    </div>
                </div>
            </section>

            {{-- Procurement Section --}}
            <section id="procurement" class="bg-white dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <span class="text-[10px] font-semibold text-deped-600 dark:text-deped-400 uppercase tracking-[0.2em]">Procurement</span>
                            <h2 class="mt-1 text-2xl lg:text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Procurement Tracking</h2>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Real-time monitoring of bids, awards, and procurement status.</p>
                        </div>
                        <a href="{{ route('bac-matters') }}" class="hidden sm:inline-flex items-center gap-1 text-xs font-medium text-deped-600 dark:text-deped-400 hover:underline">
                            View all <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="p-5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:border-amber-200 dark:hover:border-amber-800 transition group">
                            <div class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-lg bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center text-amber-600 dark:text-amber-400 shrink-0">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <span class="text-[10px] font-semibold text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-900/20 px-2 py-0.5 rounded uppercase">Invitation to Bid</span>
                                    <a href="#" class="block mt-1.5 text-sm font-medium text-gray-900 dark:text-white group-hover:text-deped-600 dark:group-hover:text-deped-400 transition leading-snug">Printing and Delivery of Reading Materials for Key Stage 1 Learners</a>
                                    <div class="mt-2 flex items-center gap-3 text-xs text-gray-400">
                                        <span class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Jun 28, 2025</span>
                                        <span class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>&#x20B1;2.4M</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:border-amber-200 dark:hover:border-amber-800 transition group">
                            <div class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-lg bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center text-amber-600 dark:text-amber-400 shrink-0">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <span class="text-[10px] font-semibold text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-900/20 px-2 py-0.5 rounded uppercase">Invitation to Bid</span>
                                    <a href="#" class="block mt-1.5 text-sm font-medium text-gray-900 dark:text-white group-hover:text-deped-600 dark:group-hover:text-deped-400 transition leading-snug">Security Services for School Year 2025-2026</a>
                                    <div class="mt-2 flex items-center gap-3 text-xs text-gray-400">
                                        <span class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Jun 15, 2025</span>
                                        <span class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>&#x20B1;1.8M</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:border-green-200 dark:hover:border-green-800 transition group">
                            <div class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-lg bg-green-50 dark:bg-green-900/20 flex items-center justify-center text-green-600 dark:text-green-400 shrink-0">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <span class="text-[10px] font-semibold text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20 px-2 py-0.5 rounded uppercase">Awarded</span>
                                    <a href="#" class="block mt-1.5 text-sm font-medium text-gray-900 dark:text-white group-hover:text-deped-600 dark:group-hover:text-deped-400 transition leading-snug">Supply and Delivery of ICT Equipment for Division Office</a>
                                    <div class="mt-2 flex items-center gap-3 text-xs text-gray-400">
                                        <span class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Jun 10, 2025</span>
                                        <span class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>&#x20B1;3.1M</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:border-blue-200 dark:hover:border-blue-800 transition group">
                            <div class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400 shrink-0">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <span class="text-[10px] font-semibold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 px-2 py-0.5 rounded uppercase">Upcoming</span>
                                    <a href="#" class="block mt-1.5 text-sm font-medium text-gray-900 dark:text-white group-hover:text-deped-600 dark:group-hover:text-deped-400 transition leading-snug">Procurement of Meals and Accommodation — Regional Training of Trainers</a>
                                    <div class="mt-2 flex items-center gap-3 text-xs text-gray-400">
                                        <span class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Jul 5, 2025</span>
                                        <span class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>&#x20B1;0.9M</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-center sm:hidden">
                        <a href="{{ route('bac-matters') }}" class="inline-flex items-center gap-1 text-xs font-medium text-deped-600 dark:text-deped-400 hover:underline">
                            View all procurement <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </section>

            {{-- Budget Allocation Section --}}
            <section id="budget" class="bg-gray-50 dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <span class="text-[10px] font-semibold text-deped-600 dark:text-deped-400 uppercase tracking-[0.2em]">Budget</span>
                            <h2 class="mt-1 text-2xl lg:text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Budget Allocation Metrics</h2>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Division budget breakdown by major expense categories.</p>
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="p-5 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                            <span class="text-xs text-gray-500 dark:text-gray-400">MOOE</span>
                            <div class="mt-1 text-xl font-bold text-gray-900 dark:text-white">&#x20B1;24.1M</div>
                            <div class="mt-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                                <div class="bg-deped-500 h-1.5 rounded-full" style="width: 65%"></div>
                            </div>
                            <p class="mt-1 text-[10px] text-gray-400">65% utilized</p>
                        </div>
                        <div class="p-5 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                            <span class="text-xs text-gray-500 dark:text-gray-400">PS (Personnel Services)</span>
                            <div class="mt-1 text-xl font-bold text-gray-900 dark:text-white">&#x20B1;18.5M</div>
                            <div class="mt-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                                <div class="bg-sdo-500 h-1.5 rounded-full" style="width: 82%"></div>
                            </div>
                            <p class="mt-1 text-[10px] text-gray-400">82% obligated</p>
                        </div>
                        <div class="p-5 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                            <span class="text-xs text-gray-500 dark:text-gray-400">CO (Capital Outlay)</span>
                            <div class="mt-1 text-xl font-bold text-gray-900 dark:text-white">&#x20B1;3.6M</div>
                            <div class="mt-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                                <div class="bg-amber-500 h-1.5 rounded-full" style="width: 40%"></div>
                            </div>
                            <p class="mt-1 text-[10px] text-gray-400">40% utilized</p>
                        </div>
                        <div class="p-5 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Total Available</span>
                            <div class="mt-1 text-xl font-bold text-gray-900 dark:text-white">&#x20B1;48.2M</div>
                            <div class="mt-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                                <div class="bg-deped-500 h-1.5 rounded-full" style="width: 67%"></div>
                            </div>
                            <p class="mt-1 text-[10px] text-gray-400">67% overall obligation rate</p>
                        </div>
                    </div>
                    <div class="mt-6 p-4 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                            <div class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-deped-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-xs">Budget data is updated monthly. Figures reflect the latest available obligation reports.</span>
                            </div>
                            <a href="{{ route('transparency-seal') }}" class="shrink-0 inline-flex items-center gap-1 text-xs font-medium text-deped-600 dark:text-deped-400 hover:underline">
                                View detailed reports <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Financial Transparency Tools --}}
            <section class="bg-white dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
                    <div class="text-center max-w-2xl mx-auto">
                        <span class="text-[10px] font-semibold text-deped-600 dark:text-deped-400 uppercase tracking-[0.2em]">Transparency</span>
                        <h2 class="mt-1 text-2xl lg:text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Financial Transparency Tools</h2>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Access key financial documents and transparency instruments.</p>
                    </div>
                    <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('transparency-seal') }}" class="p-5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:border-deped-200 dark:hover:border-deped-800 transition group">
                            <div class="w-10 h-10 rounded-lg bg-deped-100 dark:bg-deped-900/30 flex items-center justify-center text-deped-600 dark:text-deped-400 group-hover:scale-110 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <h3 class="mt-3 text-sm font-semibold text-gray-900 dark:text-white">Transparency Seal</h3>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Budget, procurement, and agency reports</p>
                        </a>
                        <a href="{{ route('citizens-charter') }}" class="p-5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:border-deped-200 dark:hover:border-deped-800 transition group">
                            <div class="w-10 h-10 rounded-lg bg-deped-100 dark:bg-deped-900/30 flex items-center justify-center text-deped-600 dark:text-deped-400 group-hover:scale-110 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <h3 class="mt-3 text-sm font-semibold text-gray-900 dark:text-white">Citizen's Charter</h3>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Service standards and procedures</p>
                        </a>
                        <a href="{{ route('bac-matters') }}" class="p-5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:border-deped-200 dark:hover:border-deped-800 transition group">
                            <div class="w-10 h-10 rounded-lg bg-deped-100 dark:bg-deped-900/30 flex items-center justify-center text-deped-600 dark:text-deped-400 group-hover:scale-110 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            </div>
                            <h3 class="mt-3 text-sm font-semibold text-gray-900 dark:text-white">Procurement Monitor</h3>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Bids, awards, and procurement tracking</p>
                        </a>
                        <a href="{{ route('issuances') }}" class="p-5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:border-deped-200 dark:hover:border-deped-800 transition group">
                            <div class="w-10 h-10 rounded-lg bg-deped-100 dark:bg-deped-900/30 flex items-center justify-center text-deped-600 dark:text-deped-400 group-hover:scale-110 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                            </div>
                            <h3 class="mt-3 text-sm font-semibold text-gray-900 dark:text-white">Financial Issuances</h3>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Budget and finance-related memorandums</p>
                        </a>
                    </div>
                </div>
            </section>

            {{-- CTA / Access --}}
            <section class="bg-gray-50 dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
                    <div class="bg-gradient-to-r from-deped-600 to-deped-800 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 lg:p-10 text-center shadow-sm">
                        <div class="inline-flex items-center justify-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white/80 text-xs font-medium border border-white/20 mb-4">
                            DepEd SDO Ligao City
                        </div>
                        <h2 class="text-2xl lg:text-3xl font-bold text-white tracking-tight">Access the Finance Management Portal</h2>
                        <p class="mt-2 text-white/80 max-w-lg mx-auto text-sm">Personnel, school heads, and suppliers can track procurement, monitor budget allocation, and access financial transparency reports.</p>
                        <div class="mt-6 flex flex-wrap justify-center gap-3">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/admin') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-deped-700 bg-white hover:bg-white/90 rounded-xl shadow-lg transition">
                                        Go to Dashboard <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-deped-700 bg-white hover:bg-white/90 rounded-xl shadow-lg transition">
                                        Access Portal <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                    </a>
                                @endauth
                            @endif
                            @auth
                                <a href="{{ url('/admin') }}" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 hover:border-deped-300 dark:hover:border-deped-700 rounded-xl shadow-sm transition">
                                    Go to my Portal
                                </a>
                            @else
                                <a href="{{ url('/admin') }}" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 hover:border-deped-300 dark:hover:border-deped-700 rounded-xl shadow-sm transition">
                                    Access Portal
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </section>
        </main>

        {{-- Footer --}}
        <footer class="bg-white dark:bg-gray-950 border-t border-gray-200 dark:border-gray-800">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="sm:col-span-2 lg:col-span-1">
                        <div class="flex items-center gap-2.5">
                            <img src="{{ asset('images/ligao-logo.png') }}" alt="SDO Ligao City" class="w-8 h-8 object-contain">
                            <div>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">Finance Management Portal</span>
                                <p class="text-[10px] text-gray-500 dark:text-gray-400">DepEd SDO Ligao City</p>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                            The primary digital gateway for procurement tracking, budget allocation metrics, and financial transparency.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-[10px] font-semibold uppercase tracking-wider text-gray-900 dark:text-white">Finance Tools</h4>
                        <ul class="mt-3 space-y-1.5">
                            <li><a href="#procurement" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">Procurement Tracking</a></li>
                            <li><a href="#budget" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">Budget Allocation</a></li>
                            <li><a href="{{ route('bac-matters') }}" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">BAC Matters</a></li>
                            <li><a href="{{ route('transparency-seal') }}" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">Transparency Seal</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-[10px] font-semibold uppercase tracking-wider text-gray-900 dark:text-white">DepEd Links</h4>
                        <ul class="mt-3 space-y-1.5">
                            <li><a href="https://deped.gov.ph" target="_blank" rel="noopener" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">DepEd Philippines</a></li>
                            <li><a href="https://www.dbm.gov.ph" target="_blank" rel="noopener" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">DBM</a></li>
                            <li><a href="https://www.coa.gov.ph" target="_blank" rel="noopener" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">COA</a></li>
                            <li><a href="https://deped.gov.ph/region-v" target="_blank" rel="noopener" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">Region V</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-[10px] font-semibold uppercase tracking-wider text-gray-900 dark:text-white">Contact</h4>
                        <ul class="mt-3 space-y-1.5 text-xs text-gray-500 dark:text-gray-400">
                            <li>Washington St., Binatagan</li>
                            <li>Ligao City 4504, Albay</li>
                            <li>(052) 485-2496</li>
                            <li>ligao.city@deped.gov.ph</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-400 dark:text-gray-500">
                    <span>&copy; {{ date('Y') }} DepEd SDO Ligao City. All rights reserved.</span>
                    <span>Finance Management Portal &bull; DepEd Region V</span>
                </div>
            </div>
        </footer>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
