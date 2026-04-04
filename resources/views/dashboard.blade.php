<x-app-layout>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <div
        class="relative min-h-[calc(100vh-5rem)] w-full overflow-hidden text-slate-100 antialiased"
        style="font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;"
    >
        <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-cyan-950" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -top-32 -right-32 h-96 w-96 rounded-full bg-cyan-500/15 blur-3xl" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -bottom-48 -left-24 h-[28rem] w-[28rem] rounded-full bg-teal-400/10 blur-3xl" aria-hidden="true"></div>
        <div
            class="pointer-events-none absolute inset-0 opacity-[0.35] [background-image:linear-gradient(rgba(255,255,255,0.06)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.06)_1px,transparent_1px)] [background-size:48px_48px]"
            aria-hidden="true"
        ></div>

        <div class="relative z-10 mx-auto max-w-6xl px-5 py-10 sm:px-8 lg:px-10 lg:py-12">
            <header class="flex flex-col gap-8 sm:flex-row sm:items-end sm:justify-between dash-enter">
                <div class="max-w-2xl">
                    <p class="mb-4 inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-medium text-cyan-100 ring-1 ring-white/15 backdrop-blur-sm">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.8)]" aria-hidden="true"></span>
                        Last calendar week (Mon–Sun)
                    </p>
                    <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        Laboratory
                        <span class="bg-gradient-to-r from-cyan-200 to-teal-200 bg-clip-text text-transparent">dashboard</span>
                    </h1>
                    <p class="mt-4 max-w-xl text-pretty text-base leading-relaxed text-slate-300">
                        All figures below cover
                        <strong class="font-semibold text-slate-200">{{ $weekStart->format('j M') }} – {{ $weekEnd->format('j M Y') }}</strong>
                        only—not all-time totals.
                    </p>
                </div>
                <div class="flex flex-col gap-3 sm:items-end">
                    <time
                        class="inline-flex flex-col rounded-xl bg-white/5 px-4 py-3 text-left ring-1 ring-white/10 backdrop-blur-sm sm:items-end sm:text-right"
                        datetime="{{ now()->toDateString() }}"
                    >
                        <span class="text-[0.65rem] font-semibold uppercase tracking-[0.18em] text-cyan-200/90">{{ now()->format('l') }}</span>
                        <span class="mt-1 text-sm font-semibold text-white">{{ now()->format('j M Y') }}</span>
                    </time>
                    <p class="text-xs text-slate-400">
                        Signed in as <span class="font-semibold text-slate-200">{{ auth()->user()->name }}</span>
                    </p>
                </div>
            </header>

            <section class="mt-12" aria-label="Key statistics">
                <h2 class="sr-only">Statistics</h2>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <article
                        class="dash-enter rounded-xl bg-white/5 p-5 ring-1 ring-cyan-400/25 backdrop-blur-sm transition duration-300 hover:bg-white/[0.07] hover:ring-cyan-300/35"
                        style="animation-delay: 0.05s"
                    >
                        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 text-cyan-300 ring-1 ring-white/15">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-[0.7rem] font-semibold uppercase tracking-wider text-slate-400">Pending (last week)</p>
                        <p class="mt-1 text-3xl font-bold tabular-nums tracking-tight text-white sm:text-4xl">{{ number_format($pendingTests) }}</p>
                        <p class="mt-2 text-xs leading-relaxed text-slate-400">Ordered that week, still awaiting results</p>
                    </article>

                    <article
                        class="dash-enter rounded-xl bg-white/5 p-5 ring-1 ring-white/10 backdrop-blur-sm transition duration-300 hover:bg-white/[0.07] hover:ring-white/20"
                        style="animation-delay: 0.1s"
                    >
                        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 text-teal-300 ring-1 ring-white/15">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                            </svg>
                        </div>
                        <p class="text-[0.7rem] font-semibold uppercase tracking-wider text-slate-400">Test orders (last week)</p>
                        <p class="mt-1 text-3xl font-bold tabular-nums tracking-tight text-white sm:text-4xl">{{ number_format($testsOrderedLastWeek) }}</p>
                        <p class="mt-2 text-xs leading-relaxed text-slate-400">Total tests ordered in that week</p>
                    </article>

                    <article
                        class="dash-enter rounded-xl bg-white/5 p-5 ring-1 ring-white/10 backdrop-blur-sm transition duration-300 hover:bg-white/[0.07] hover:ring-white/20"
                        style="animation-delay: 0.15s"
                    >
                        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 text-emerald-300 ring-1 ring-white/15">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-[0.7rem] font-semibold uppercase tracking-wider text-slate-400">Completed (last week)</p>
                        <p class="mt-1 text-3xl font-bold tabular-nums tracking-tight text-white sm:text-4xl">{{ number_format($completedLastWeek) }}</p>
                        <p class="mt-2 text-xs leading-relaxed text-slate-400">Distinct tests with results logged that week</p>
                    </article>

                    <article
                        class="dash-enter rounded-xl bg-white/5 p-5 ring-1 ring-white/10 backdrop-blur-sm transition duration-300 hover:bg-white/[0.07] hover:ring-white/20"
                        style="animation-delay: 0.2s"
                    >
                        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 text-cyan-200 ring-1 ring-white/15">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                            </svg>
                        </div>
                        <p class="text-[0.7rem] font-semibold uppercase tracking-wider text-slate-400">New patients (last week)</p>
                        <p class="mt-1 text-3xl font-bold tabular-nums tracking-tight text-white sm:text-4xl">{{ number_format($newPatientsLastWeek) }}</p>
                        <p class="mt-2 text-xs leading-relaxed text-slate-400">Registrations in that week</p>
                    </article>

                    <article
                        class="dash-enter sm:col-span-2 lg:col-span-4 rounded-xl bg-white/5 p-6 ring-1 ring-white/10 backdrop-blur-sm"
                        style="animation-delay: 0.25s"
                    >
                        <div class="flex flex-wrap items-center justify-center gap-6 text-center sm:justify-around sm:gap-10">
                            <div>
                                <p class="text-[0.7rem] font-semibold uppercase tracking-wider text-slate-400">Reporting period</p>
                                <p class="mt-1 text-lg font-bold tabular-nums text-white sm:text-xl">
                                    {{ $weekStart->format('D j M') }}
                                    <span class="font-normal text-slate-500">&rarr;</span>
                                    {{ $weekEnd->format('D j M Y') }}
                                </p>
                            </div>
                            <div class="hidden h-12 w-px bg-gradient-to-b from-transparent via-white/20 to-transparent sm:block" aria-hidden="true"></div>
                            <div class="max-w-md">
                                <p class="text-xs leading-relaxed text-slate-400">
                                    Weeks run Monday to Sunday. Orders use test row dates when available; otherwise the patient registration date.
                                    Completions count distinct tests that received at least one result row during this week.
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
            </section>

            <section class="mt-14 dash-enter" style="animation-delay: 0.3s" aria-label="Quick actions">
                <h2 class="text-lg font-bold text-white">Quick actions</h2>
                <p class="mt-1 text-sm text-slate-400">Jump back into daily lab workflows</p>
                <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                    <a
                        href="{{ route('new-case') }}"
                        wire:navigate
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-cyan-500 to-teal-500 px-6 py-3.5 text-sm font-semibold text-slate-900 shadow-lg shadow-cyan-900/30 transition hover:from-cyan-400 hover:to-teal-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-300 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900"
                    >
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                        New case
                    </a>
                    <a
                        href="{{ route('cases-list') }}"
                        wire:navigate
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/25 bg-white/5 px-6 py-3.5 text-sm font-semibold text-white shadow-sm backdrop-blur-sm transition hover:bg-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-300 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900"
                    >
                        <svg class="h-5 w-5 text-cyan-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                        </svg>
                        Case list
                    </a>
                </div>
            </section>

            <footer class="mt-14 border-t border-white/10 pt-8 text-center text-xs text-slate-500 sm:text-left">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laboratory') }}. Pathology information system.</p>
            </footer>
        </div>
    </div>

    <style>
        @keyframes dash-enter {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .dash-enter {
            animation: dash-enter 0.65s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        @media (prefers-reduced-motion: reduce) {
            .dash-enter {
                animation: none;
                opacity: 1;
                transform: none;
            }
        }
    </style>
</x-app-layout>
