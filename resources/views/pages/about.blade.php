<x-sdo-layout title="About">
    <section class="bg-white dark:bg-gray-950 border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
            <div class="max-w-3xl mx-auto text-center">
                <span class="text-[10px] font-semibold text-deped-600 dark:text-deped-400 uppercase tracking-[0.2em]">About</span>
                <h1 class="mt-3 text-3xl lg:text-4xl font-bold tracking-tight text-gray-900 dark:text-white">Finance Management Portal</h1>
                <p class="mt-3 text-sm text-gray-500 dark:text-gray-400">The primary digital gateway for financial transparency, procurement tracking, and budget oversight at DepEd SDO Ligao City.</p>
            </div>

            <div class="mt-10 max-w-3xl mx-auto space-y-6 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                <div class="p-6 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800">
                    <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-2">Our Mission</h2>
                    <p>To promote transparency, accountability, and integrity in the management of division funds through real-time procurement tracking, budget allocation metrics, and accessible financial reports for personnel, school heads, suppliers, and the general public.</p>
                </div>

                <div class="p-6 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800">
                    <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-2">Legal Framework</h2>
                    <p>This portal is established in compliance with the following transparency mandates:</p>
                    <ul class="mt-2 space-y-1.5 list-disc list-inside">
                        <li>Republic Act No. 11032 — Ease of Doing Business and Efficient Government Service Delivery Act of 2018</li>
                        <li>DepEd Order No. 50 s. 2002 — Establishment of City Schools Divisions</li>
                        <li>RA 9008 — Charter of Ligao City (2001)</li>
                        <li>COA Circular on Full Disclosure and Transparency</li>
                        <li>DBM National Budget Circulars on Fund Utilization Reporting</li>
                    </ul>
                </div>

                <div class="p-6 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800">
                    <h2 class="text-base font-semibold text-gray-900 dark:text-white mb-2">What We Track</h2>
                    <div class="grid sm:grid-cols-2 gap-3 mt-2">
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-deped-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <span>Procurement status (bidding, award, delivery)</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-deped-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <span>MOOE / PS / CO budget utilization</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-deped-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <span>Obligation rates and disbursements</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-deped-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <span>Financial issuances and memorandums</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-center">
                    <div class="flex items-center justify-center gap-4 mb-4">
                        <img src="{{ asset('images/ligao-logo.png') }}" alt="SDO Ligao City" class="w-12 h-12 object-contain">
                        <img src="{{ asset('images/sds.png') }}" alt="SDS" class="w-12 h-12 object-contain rounded-full">
                    </div>
                    <h2 class="text-base font-semibold text-gray-900 dark:text-white">DepEd SDO Ligao City</h2>
                    <p class="text-xs text-gray-400 mt-1">The 13th Division of DepEd Region V, serving Ligao City, Albay since 2003.</p>
                </div>
            </div>
        </div>
    </section>
</x-sdo-layout>
