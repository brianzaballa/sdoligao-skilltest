<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="fi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="SDO Ligao City - Schools Division Office of Ligao City, DepEd Region V">
    <title>SDO Ligao City</title>

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
                            deped: { 50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd', 400: '#60a5fa', 500: '#2563eb', 600: '#1d4ed8', 700: '#1e40af', 800: '#1e3a8a', 900: '#172554' }
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
                    <a href="/" class="flex items-center gap-3">
                        <div class="flex items-center gap-2.5">
                            <img src="{{ asset('images/ligao-logo.png') }}" alt="SDO Ligao City" class="w-8 h-8 object-contain">
                            <div>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">SDO Ligao City</span>
                                <p class="text-[10px] leading-tight text-gray-500 dark:text-gray-400 hidden sm:block">Schools Division Office</p>
                            </div>
                        </div>
                    </a>

                    <div class="hidden md:flex items-center gap-1">
                        <a href="/" class="px-3 py-1.5 text-sm font-medium text-deped-600 dark:text-deped-400">Home</a>
                        <a href="#about" class="px-3 py-1.5 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">About Us</a>
                        <a href="#contact" class="px-3 py-1.5 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">Contact</a>
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
                    <a href="#about" x-on:click="mobileOpen = false" class="block px-3 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition">About Us</a>
                    <a href="#contact" x-on:click="mobileOpen = false" class="block px-3 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition">Contact</a>
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
            <section class="bg-white dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20 text-center">
                    <div class="inline-flex items-center justify-center gap-2 px-4 py-1.5 rounded-full bg-deped-50 dark:bg-deped-900/20 text-deped-600 dark:text-deped-400 text-xs font-medium mb-6 border border-deped-100 dark:border-deped-800/50">
                        Republic of the Philippines &bull; DepEd Region V
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Schools Division Office of Ligao City
                    </h1>
                    <p class="mt-4 text-base sm:text-lg text-gray-500 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                        The official website of SDO Ligao City — committed to providing quality, accessible, and inclusive basic education for every learner.
                    </p>
                    @if (Route::has('login'))
                        @auth
                            <div class="mt-8">
                                <a href="{{ url('/admin') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-deped-600 hover:bg-deped-700 rounded-lg shadow-sm transition">
                                    Go to Dashboard
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                </a>
                            </div>
                        @else
                            <div class="mt-8">
                                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-deped-600 hover:bg-deped-700 rounded-lg shadow-sm transition">
                                    Access Portal
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                </a>
                            </div>
                        @endauth
                    @endif
                </div>
            </section>

            {{-- Quick Links --}}
            <section class="bg-white dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
                    <div class="flex flex-wrap items-center justify-center gap-2 text-sm">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mr-2">Quick Links:</span>
                        <a href="{{ route('transparency-seal') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-deped-50 dark:hover:bg-deped-900/20 hover:text-deped-600 dark:hover:text-deped-400 text-xs font-medium transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Transparency
                        </a>
                        <a href="{{ route('bac-matters') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-deped-50 dark:hover:bg-deped-900/20 hover:text-deped-600 dark:hover:text-deped-400 text-xs font-medium transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            BAC Matters
                        </a>
                        <a href="{{ route('issuances') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-deped-50 dark:hover:bg-deped-900/20 hover:text-deped-600 dark:hover:text-deped-400 text-xs font-medium transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Issuances
                        </a>
                        <a href="#about" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-deped-50 dark:hover:bg-deped-900/20 hover:text-deped-600 dark:hover:text-deped-400 text-xs font-medium transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/></svg>
                            Citizen's Charter
                        </a>
                        <a href="https://deped.gov.ph" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-deped-50 dark:hover:bg-deped-900/20 hover:text-deped-600 dark:hover:text-deped-400 text-xs font-medium transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                            DepEd PH
                        </a>
                    </div>
                </div>
            </section>

            {{-- About Us --}}
            <section id="about" class="bg-gray-50 dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
                    <div class="max-w-3xl mx-auto text-center mb-10">
                        <span class="text-[10px] font-semibold text-deped-600 dark:text-deped-400 uppercase tracking-[0.2em]">About Us</span>
                        <h2 class="mt-2 text-2xl lg:text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Tracing Our Legacy</h2>
                    </div>

                    <div class="prose prose-sm max-w-none text-gray-600 dark:text-gray-400 space-y-4">
                        <p class="leading-relaxed">
                            Pursuant to Republic Act 9008 of 2001 known as the Charter of Ligao City and by virtue of DepED Order No. 50 s. 2002 re: Establishment of Interim City Schools Division, DepED Ligao City Division was established.
                        </p>
                        <p class="leading-relaxed">
                            The Sangguniang Panglungsod of Ligao City passed and approved Resolution No. 2002-001 sponsored by Hon. Ana P. Manlangit on January 7, 2002, expressing full support to the City Government in the establishment and operation of the City Division.
                        </p>
                        <p class="leading-relaxed">
                            Adding to this support was the Memorandum of Agreement made and executed by Hon. Mayor Fernando V. Gonzalez and Regional Director Teresita Diaz-Naz, DepEd Region V.
                        </p>
                        <p class="leading-relaxed">
                            Ligao City Division began its operation on March 1, 2003, and had its approval as the <strong>13th Division of Region V</strong> on September 27, 2005.
                        </p>
                        <p class="leading-relaxed">
                            From then on, Ligao City Division has gained a name for itself through the commitment and dedication of its stakeholders — internal and external — and the various remarkable achievements in academics, athletics, and in the Alternative Learning System.
                        </p>
                    </div>

                    {{-- SDS Card --}}
                    <div class="mt-10 p-6 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm max-w-2xl mx-auto">
                        <div class="flex items-start gap-4">
                            <img src="{{ asset('images/sds.png') }}" alt="Dr. Nympha D. Guemo" class="w-40 object-contain">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Dr. Nympha D. Guemo</h3>
                                <p class="text-xs text-deped-600 dark:text-deped-400 font-medium">Schools Division Superintendent</p>
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                                    A dedicated and visionary educational leader committed to promoting excellence, integrity, and quality service in the field of education. With a strong passion for empowering both learners and educators, she continues to inspire progress, collaboration, and innovation within the school community.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Organization Chart Link --}}
                    <div class="mt-6 text-center">
                        <a href="{{ route('organizational-chart') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-deped-600 hover:bg-deped-700 rounded-lg shadow-sm transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            View Organizational Chart
                        </a>
                    </div>
                </div>
            </section>

            {{-- Vision, Mission, Core Values --}}
            <section class="bg-white dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
                    <div class="text-center mb-10">
                        <span class="text-[10px] font-semibold text-deped-600 dark:text-deped-400 uppercase tracking-[0.2em]">Our Mandate</span>
                        <h2 class="mt-2 text-2xl lg:text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Vision, Mission & Core Values</h2>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="p-6 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                            <div class="flex items-center gap-2.5 mb-4">
                                <div class="w-9 h-9 rounded-lg bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center text-amber-500">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </div>
                                <h3 class="text-base font-semibold text-gray-900 dark:text-white">Our Vision</h3>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed italic">
                                We dream of Filipinos who passionately love their country and whose values and competencies enable them to realize their full potential and contribute meaningfully to building the nation.
                            </p>
                            <p class="mt-3 text-xs text-gray-400 dark:text-gray-500">
                                As a learner-centered public institution, the Department of Education continuously improves itself to better serve its stakeholders.
                            </p>
                        </div>

                        <div class="p-6 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                            <div class="flex items-center gap-2.5 mb-4">
                                <div class="w-9 h-9 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-500">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </div>
                                <h3 class="text-base font-semibold text-gray-900 dark:text-white">Our Mission</h3>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                To protect and promote the right of every Filipino to quality, equitable, culture-based, and complete basic education where:
                            </p>
                            <ul class="mt-3 space-y-1.5 text-sm text-gray-600 dark:text-gray-400">
                                <li class="flex items-start gap-2"><svg class="w-4 h-4 mt-0.5 text-deped-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Students learn in a child-friendly, gender-sensitive, safe, and motivating environment</li>
                                <li class="flex items-start gap-2"><svg class="w-4 h-4 mt-0.5 text-deped-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Teachers facilitate learning and constantly nurture every learner</li>
                                <li class="flex items-start gap-2"><svg class="w-4 h-4 mt-0.5 text-deped-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Administrators and staff ensure an enabling and supportive environment for effective learning</li>
                                <li class="flex items-start gap-2"><svg class="w-4 h-4 mt-0.5 text-deped-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Family, community, and other stakeholders are actively engaged and share responsibility</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Core Values --}}
                    <div class="mt-8">
                        <h3 class="text-sm font-semibold text-center text-gray-900 dark:text-white mb-5">Our Core Values</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <div class="p-4 rounded-xl bg-amber-50 dark:bg-amber-900/10 border border-amber-100 dark:border-amber-900/30 text-center">
                                <span class="text-lg font-bold text-amber-600 dark:text-amber-400">Maka-Diyos</span>
                            </div>
                            <div class="p-4 rounded-xl bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/30 text-center">
                                <span class="text-lg font-bold text-red-600 dark:text-red-400">Makatao</span>
                            </div>
                            <div class="p-4 rounded-xl bg-green-50 dark:bg-green-900/10 border border-green-100 dark:border-green-900/30 text-center">
                                <span class="text-lg font-bold text-green-600 dark:text-green-400">Makakalikasan</span>
                            </div>
                            <div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-900/30 text-center">
                                <span class="text-lg font-bold text-blue-600 dark:text-blue-400">Makabansa</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Citizen's Charter --}}
            <section id="transparency" class="bg-gray-50 dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
                    <div class="max-w-3xl mx-auto">
                        <span class="text-[10px] font-semibold text-deped-600 dark:text-deped-400 uppercase tracking-[0.2em]">Transparency</span>
                        <h2 class="mt-2 text-2xl lg:text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Citizen's Charter</h2>
                        <p class="mt-3 text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                            Section 2 of the Republic Act (RA) 11032, otherwise known as the Ease of Doing Business and Efficient Government Service Delivery (EODB-EGSD) Act of 2018, promotes integrity, accountability, proper management of public affairs, and efficient turnaround of government services.
                        </p>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                            Section 6 of the Act stipulates that all government agencies shall set up their respective most current and updated service standards — the Citizen's Charter — posted conspicuously, in their websites, and published as handbooks.
                        </p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="#" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-deped-600 hover:bg-deped-700 rounded-lg shadow-sm transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Citizen's Charter 2026
                            </a>
                            <a href="#" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg shadow-sm transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                Certificate of Compliance
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Main Content: Announcements & Memorandums --}}
            <section class="bg-white dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
                    <div class="grid lg:grid-cols-3 gap-8">

                        <div class="lg:col-span-2 space-y-10">
                            {{-- Announcements --}}
                            <div>
                                <div class="flex items-center justify-between mb-5">
                                    <h2 class="text-base font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                        <span class="w-1 h-5 bg-deped-500 rounded-full inline-block"></span>
                                        Announcements
                                    </h2>
                                    <a href="#" class="text-xs font-medium text-deped-600 dark:text-deped-400 hover:underline">View all</a>
                                </div>
                                <div class="space-y-3">
                                    <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                                        <div class="flex items-start gap-3">
                                            <div class="w-10 h-10 rounded-lg bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center text-amber-600 dark:text-amber-400 shrink-0 mt-0.5">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <span class="text-[10px] font-semibold text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-900/20 px-2 py-0.5 rounded uppercase tracking-wider">Bids & Awards</span>
                                                <a href="#" class="block mt-1.5 text-sm font-medium text-gray-900 dark:text-white hover:text-deped-600 dark:hover:text-deped-400 transition leading-snug">Invitation to Bid — Printing and Delivery of Reading Materials for Key Stage 1 Learners</a>
                                                <p class="mt-1.5 text-xs text-gray-400">June 28, 2025</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                                        <div class="flex items-start gap-3">
                                            <div class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400 shrink-0 mt-0.5">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <span class="text-[10px] font-semibold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 px-2 py-0.5 rounded uppercase tracking-wider">Advisory</span>
                                                <a href="#" class="block mt-1.5 text-sm font-medium text-gray-900 dark:text-white hover:text-deped-600 dark:hover:text-deped-400 transition leading-snug">Division Training Workshop on Strengthening the Implementation of ADM</a>
                                                <p class="mt-1.5 text-xs text-gray-400">June 25, 2025</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Numbered Memorandums --}}
                            <div>
                                <div class="flex items-center justify-between mb-5">
                                    <h2 class="text-base font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                        <span class="w-1 h-5 bg-deped-500 rounded-full inline-block"></span>
                                        Latest Numbered Memorandums
                                    </h2>
                                    <a href="{{ route('issuances') }}" class="text-xs font-medium text-deped-600 dark:text-deped-400 hover:underline">View all</a>
                                </div>
                                <div class="space-y-2">
                                    <a href="#" class="block p-4 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:border-deped-200 dark:hover:border-deped-800 transition">
                                        <div class="flex items-center justify-between gap-3">
                                            <div class="flex-1 min-w-0">
                                                <span class="text-[10px] text-gray-400 font-medium">DM No. 225, s. 2025</span>
                                                <p class="mt-0.5 text-sm text-gray-900 dark:text-white hover:text-deped-600 dark:hover:text-deped-400 transition leading-snug">Participants to RASSEAE Regional Clustered Bakbakan Cup 4</p>
                                            </div>
                                            <svg class="w-4 h-4 text-gray-300 dark:text-gray-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </div>
                                    </a>
                                    <a href="#" class="block p-4 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:border-deped-200 dark:hover:border-deped-800 transition">
                                        <div class="flex items-center justify-between gap-3">
                                            <div class="flex-1 min-w-0">
                                                <span class="text-[10px] text-gray-400 font-medium">DM No. 224, s. 2025</span>
                                                <p class="mt-0.5 text-sm text-gray-900 dark:text-white hover:text-deped-600 dark:hover:text-deped-400 transition leading-snug">Integration of Historical Events in Araling Panlipunan Lessons</p>
                                            </div>
                                            <svg class="w-4 h-4 text-gray-300 dark:text-gray-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </div>
                                    </a>
                                    <a href="#" class="block p-4 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:border-deped-200 dark:hover:border-deped-800 transition">
                                        <div class="flex items-center justify-between gap-3">
                                            <div class="flex-1 min-w-0">
                                                <span class="text-[10px] text-gray-400 font-medium">DM No. 223, s. 2025</span>
                                                <p class="mt-0.5 text-sm text-gray-900 dark:text-white hover:text-deped-600 dark:hover:text-deped-400 transition leading-snug">2025 Observance of Filipino Values Month</p>
                                            </div>
                                            <svg class="w-4 h-4 text-gray-300 dark:text-gray-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </div>
                                    </a>
                                    <a href="#" class="block p-4 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:border-deped-200 dark:hover:border-deped-800 transition">
                                        <div class="flex items-center justify-between gap-3">
                                            <div class="flex-1 min-w-0">
                                                <span class="text-[10px] text-gray-400 font-medium">DM No. 194, s. 2025</span>
                                                <p class="mt-0.5 text-sm text-gray-900 dark:text-white hover:text-deped-600 dark:hover:text-deped-400 transition leading-snug">Adoption of the Interim Structure of NEAP in Region V</p>
                                            </div>
                                            <svg class="w-4 h-4 text-gray-300 dark:text-gray-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            {{-- Unnumbered Memorandums --}}
                            <div>
                                <div class="flex items-center justify-between mb-5">
                                    <h2 class="text-base font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                        <span class="w-1 h-5 bg-deped-500 rounded-full inline-block"></span>
                                        Unnumbered Memorandums
                                    </h2>
                                    <a href="{{ route('issuances') }}" class="text-xs font-medium text-deped-600 dark:text-deped-400 hover:underline">View all</a>
                                </div>
                                <div class="grid sm:grid-cols-2 gap-2">
                                    <a href="#" class="block p-3.5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:border-deped-200 dark:hover:border-deped-800 transition">
                                        <p class="text-sm text-gray-900 dark:text-white hover:text-deped-600 dark:hover:text-deped-400 transition leading-snug">Online Orientation on the Preparation of School LAC Proposal</p>
                                        <span class="text-[10px] text-gray-400 mt-1.5 block">May 15, 2025</span>
                                    </a>
                                    <a href="#" class="block p-3.5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:border-deped-200 dark:hover:border-deped-800 transition">
                                        <p class="text-sm text-gray-900 dark:text-white hover:text-deped-600 dark:hover:text-deped-400 transition leading-snug">Regional Training Workshop on Mobile Journalism</p>
                                        <span class="text-[10px] text-gray-400 mt-1.5 block">May 10, 2025</span>
                                    </a>
                                    <a href="#" class="block p-3.5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:border-deped-200 dark:hover:border-deped-800 transition">
                                        <p class="text-sm text-gray-900 dark:text-white hover:text-deped-600 dark:hover:text-deped-400 transition leading-snug">ALS Semi-Annual Meeting for ALS-SHS Implementers</p>
                                        <span class="text-[10px] text-gray-400 mt-1.5 block">May 8, 2025</span>
                                    </a>
                                    <a href="#" class="block p-3.5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:border-deped-200 dark:hover:border-deped-800 transition">
                                        <p class="text-sm text-gray-900 dark:text-white hover:text-deped-600 dark:hover:text-deped-400 transition leading-snug">Division PTA Forum — SY 2025-2026</p>
                                        <span class="text-[10px] text-gray-400 mt-1.5 block">May 5, 2025</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Sidebar --}}
                        <div class="space-y-6">
                            <div class="p-5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                                <div class="flex items-center gap-3 mb-4">
                                    <img src="{{ asset('images/ligao-logo.png') }}" alt="SDO Ligao City" class="w-10 h-10 object-contain">
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">About SDO Ligao City</h3>
                                        <p class="text-[10px] text-gray-400">DepEd Region V &bull; 13th Division</p>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                                    Established March 1, 2003. Approved as the 13th Division of Region V on September 27, 2005. Serving 38 public schools and over 25,000 learners in Ligao City, Albay.
                                </p>
                                <a href="#about" class="mt-3 inline-flex items-center gap-1 text-xs font-medium text-deped-600 dark:text-deped-400 hover:underline">
                                    Learn more <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>

                            <div class="p-5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                                <div class="flex items-center gap-2.5 mb-3">
                                    <div class="w-8 h-8 rounded-lg bg-deped-100 dark:bg-deped-900/30 flex items-center justify-center text-deped-600 dark:text-deped-400 text-xs font-bold">SDS</div>
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Dr. Nympha D. Guemo</h3>
                                        <p class="text-[10px] text-deped-600 dark:text-deped-400">Schools Division Superintendent</p>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                                    Leading with excellence, integrity, and a deep commitment to quality education for every learner in Ligao City.
                                </p>
                            </div>

                            <div class="p-5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">External Links</h3>
                                <ul class="space-y-2">
                                    <li><a href="https://deped.gov.ph" target="_blank" rel="noopener" class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition"><span class="w-1.5 h-1.5 rounded-full bg-deped-400 shrink-0"></span>DepEd Philippines</a></li>
                                    <li><a href="https://lrmds.deped.gov.ph" target="_blank" rel="noopener" class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition"><span class="w-1.5 h-1.5 rounded-full bg-deped-400 shrink-0"></span>LRMDS</a></li>
                                    <li><a href="https://commons.deped.gov.ph" target="_blank" rel="noopener" class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition"><span class="w-1.5 h-1.5 rounded-full bg-deped-400 shrink-0"></span>DepEd Commons</a></li>
                                    <li><a href="https://deped.gov.ph/region-v" target="_blank" rel="noopener" class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition"><span class="w-1.5 h-1.5 rounded-full bg-deped-400 shrink-0"></span>Region V</a></li>
                                </ul>
                            </div>

                            <div id="contact" class="p-5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Contact</h3>
                                <ul class="space-y-2.5 text-xs text-gray-600 dark:text-gray-400">
                                    <li class="flex items-start gap-2.5">
                                        <svg class="w-3.5 h-3.5 mt-0.5 text-deped-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        <span>Washington Street, Binatagan, Ligao City 4504</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <svg class="w-3.5 h-3.5 mt-0.5 text-deped-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        <div>
                                            <span class="block">ligao.city@deped.gov.ph</span>
                                            <span class="block">admin.r5.ligaocity@deped.gov.ph</span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <svg class="w-3.5 h-3.5 mt-0.5 text-deped-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                        <div>
                                            <span class="block">(052) 485-2496</span>
                                            <span class="block">(052) 820-3409</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        {{-- Footer --}}
        <footer class="bg-white dark:bg-gray-950 border-t border-gray-200 dark:border-gray-800">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="sm:col-span-2 lg:col-span-1">
                        <div class="flex items-center gap-2.5">
                            <img src="{{ asset('images/ligao-logo.png') }}" alt="SDO Ligao City" class="w-8 h-8 object-contain">
                            <div>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">SDO Ligao City</span>
                                <p class="text-[10px] text-gray-500 dark:text-gray-400">Schools Division Office</p>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                            The 13th Division of DepEd Region V, serving Ligao City, Albay since 2003.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-[10px] font-semibold uppercase tracking-wider text-gray-900 dark:text-white">Pages</h4>
                        <ul class="mt-3 space-y-1.5">
                            <li><a href="#about" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">About Us</a></li>
                            <li><a href="{{ route('issuances') }}" class="text-xs text-gray-500 dark:text-gray-400 hover:text-deped-600 dark:hover:text-deped-400 transition">Issuances</a></li>
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
                    <span>&copy; {{ date('Y') }} SDO Ligao City. All rights reserved.</span>
                    <span>Schools Division Office of Ligao City &bull; DepEd Region V</span>
                </div>
            </div>
        </footer>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
