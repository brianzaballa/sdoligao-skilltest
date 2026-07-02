<x-sdo-layout title="Organizational Chart">
    <section class="bg-white dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
            <div class="max-w-3xl mx-auto text-center">
                <span class="text-[10px] font-semibold text-deped-600 dark:text-deped-400 uppercase tracking-[0.2em]">Organization</span>
                <h1 class="mt-3 text-3xl lg:text-4xl font-bold tracking-tight text-gray-900 dark:text-white">Finance Management Structure</h1>
                <p class="mt-3 text-sm text-gray-500 dark:text-gray-400">The division offices and personnel responsible for financial management, procurement, and budget oversight.</p>
            </div>

            <div class="mt-10 max-w-3xl mx-auto">
                {{-- SDS --}}
                <div class="text-center mb-6">
                    <div class="inline-block p-5 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                        <img src="{{ asset('images/sds.png') }}" alt="SDS" class="w-16 h-16 object-contain rounded-full mx-auto">
                        <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">Dr. Nympha D. Guemo</h3>
                        <p class="text-[10px] text-gray-500">Schools Division Superintendent</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">Overall Authority on Division Finance</p>
                    </div>
                </div>

                {{-- Connector line --}}
                <div class="flex justify-center mb-6">
                    <div class="w-px h-6 bg-gray-300 dark:bg-gray-700"></div>
                </div>

                {{-- ASDS row --}}
                <div class="grid sm:grid-cols-2 gap-4 mb-6">
                    <div class="text-center p-4 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-deped-100 dark:bg-deped-900/30 flex items-center justify-center text-deped-600 dark:text-deped-400 mx-auto">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">Assistant Schools Division Superintendent</h3>
                        <p class="text-[10px] text-gray-500">Co-signatory on Financial Documents</p>
                    </div>
                    <div class="text-center p-4 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-deped-100 dark:bg-deped-900/30 flex items-center justify-center text-deped-600 dark:text-deped-400 mx-auto">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">Administrative Officer V</h3>
                        <p class="text-[10px] text-gray-500">Division Finance and Budget Officer</p>
                    </div>
                </div>

                {{-- Connector --}}
                <div class="flex justify-center mb-6">
                    <div class="w-px h-6 bg-gray-300 dark:bg-gray-700"></div>
                </div>

                {{-- Finance units --}}
                <div class="grid sm:grid-cols-3 gap-4">
                    <div class="text-center p-4 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                        <div class="w-10 h-10 rounded-lg bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center text-amber-600 dark:text-amber-400 mx-auto">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">Budget Unit</h3>
                        <p class="text-[10px] text-gray-500">Budget preparation, allocation, and monitoring</p>
                    </div>
                    <div class="text-center p-4 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                        <div class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400 mx-auto">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        </div>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">Accounting Unit</h3>
                        <p class="text-[10px] text-gray-500">Disbursement, liquidation, and financial reporting</p>
                    </div>
                    <div class="text-center p-4 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm">
                        <div class="w-10 h-10 rounded-lg bg-green-50 dark:bg-green-900/20 flex items-center justify-center text-green-600 dark:text-green-400 mx-auto">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        </div>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">Procurement / BAC</h3>
                        <p class="text-[10px] text-gray-500">Bidding, awards, and contract management</p>
                    </div>
                </div>

                <div class="mt-6 p-4 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-center">
                    <p class="text-xs text-gray-500">This simplified chart highlights the finance and procurement structure. For the complete division organizational chart, visit the <a href="https://depedligaocity.net" target="_blank" rel="noopener" class="text-deped-600 dark:text-deped-400 underline">official SDO Ligao City website</a>.</p>
                </div>
            </div>
        </div>
    </section>
</x-sdo-layout>
