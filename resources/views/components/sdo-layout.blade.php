<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="fi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="DepEd SDO Ligao City Finance Management Portal — Procurement Tracking, Budget Metrics, and Financial Transparency">
    <title>{{ $title ?? '' }} — Finance Portal — SDO Ligao City</title>

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
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-14">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <div class="flex items-center gap-2.5">
                            <img src="{{ asset('images/ligao-logo.png') }}" alt="SDO Ligao City" class="w-8 h-8 object-contain">
                            <div>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">Finance Management Portal</span>
                                <p class="text-[10px] leading-tight text-gray-500 dark:text-gray-400 hidden sm:block">DepEd SDO Ligao City</p>
                            </div>
                        </div>
                    </a>

                    <div class="hidden md:flex items-center gap-1">
                        <a href="{{ url('/') }}" class="px-3 py-1.5 text-sm font-medium {{ request()->is('/') ? 'text-deped-600 dark:text-deped-400' : 'text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400' }} transition">Home</a>
                        <a href="{{ route('about') }}" class="px-3 py-1.5 text-sm font-medium {{ request()->routeIs('about') ? 'text-deped-600 dark:text-deped-400' : 'text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400' }} transition">About</a>
                        <a href="{{ route('issuances') }}" class="px-3 py-1.5 text-sm font-medium {{ request()->routeIs('issuances') ? 'text-deped-600 dark:text-deped-400' : 'text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400' }} transition">Issuances</a>
                        <a href="{{ route('bac-matters') }}" class="px-3 py-1.5 text-sm font-medium {{ request()->routeIs('bac-matters') ? 'text-deped-600 dark:text-deped-400' : 'text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400' }} transition">BAC Matters</a>
                        <a href="{{ route('transparency-seal') }}" class="px-3 py-1.5 text-sm font-medium {{ request()->routeIs('transparency-seal') ? 'text-deped-600 dark:text-deped-400' : 'text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400' }} transition">Transparency</a>
                        <a href="{{ route('contact') }}" class="px-3 py-1.5 text-sm font-medium {{ request()->routeIs('contact') ? 'text-deped-600 dark:text-deped-400' : 'text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400' }} transition">Contact</a>

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
                    <a href="{{ url('/') }}" x-on:click="mobileOpen = false" class="block px-3 py-2 text-sm font-medium {{ request()->is('/') ? 'text-deped-600 dark:text-deped-400' : 'text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400' }} rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition">Home</a>
                    <a href="{{ route('about') }}" x-on:click="mobileOpen = false" class="block px-3 py-2 text-sm font-medium {{ request()->routeIs('about') ? 'text-deped-600 dark:text-deped-400' : 'text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400' }} rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition">About</a>
                    <a href="{{ route('issuances') }}" x-on:click="mobileOpen = false" class="block px-3 py-2 text-sm font-medium {{ request()->routeIs('issuances') ? 'text-deped-600 dark:text-deped-400' : 'text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400' }} rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition">Issuances</a>
                    <a href="{{ route('bac-matters') }}" x-on:click="mobileOpen = false" class="block px-3 py-2 text-sm font-medium {{ request()->routeIs('bac-matters') ? 'text-deped-600 dark:text-deped-400' : 'text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400' }} rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition">BAC Matters</a>
                    <a href="{{ route('transparency-seal') }}" x-on:click="mobileOpen = false" class="block px-3 py-2 text-sm font-medium {{ request()->routeIs('transparency-seal') ? 'text-deped-600 dark:text-deped-400' : 'text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400' }} rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition">Transparency</a>
                    <a href="{{ route('contact') }}" x-on:click="mobileOpen = false" class="block px-3 py-2 text-sm font-medium {{ request()->routeIs('contact') ? 'text-deped-600 dark:text-deped-400' : 'text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400' }} rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition">Contact</a>
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
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="bg-white dark:bg-gray-950 border-t border-gray-200 dark:border-gray-800">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
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
                            <li><a href="{{ url('/#procurement') }}" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">Procurement Tracking</a></li>
                            <li><a href="{{ url('/#budget') }}" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">Budget Allocation</a></li>
                            <li><a href="{{ route('bac-matters') }}" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">BAC Matters</a></li>
                            <li><a href="{{ route('transparency-seal') }}" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">Transparency Seal</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-[10px] font-semibold uppercase tracking-wider text-gray-900 dark:text-white">DepEd Links</h4>
                        <ul class="mt-3 space-y-1.5">
                            <li><a href="https://deped.gov.ph" target="_blank" rel="noopener" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">DepEd Philippines</a></li>
                            <li><a href="https://lrmds.deped.gov.ph" target="_blank" rel="noopener" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">LRMDS</a></li>
                            <li><a href="https://commons.deped.gov.ph" target="_blank" rel="noopener" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">DepEd Commons</a></li>
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
