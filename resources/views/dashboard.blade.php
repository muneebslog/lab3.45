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

            @if (auth()->user()?->isAdmin())
                <section class="mt-14 dash-enter" style="animation-delay: 0.3s" aria-label="Admin alerts">
                    <div class="flex items-center gap-3">
                        <h2 class="text-lg font-bold text-white">Admin alerts</h2>
                        @php
                            $totalAlerts = $unprintedReports->total() + $missingResults->total();
                        @endphp
                        @if ($totalAlerts > 0)
                            <span class="inline-flex h-6 min-w-6 items-center justify-center rounded-full bg-rose-500 px-2 text-xs font-bold text-white">
                                {{ $totalAlerts }}
                            </span>
                        @endif
                    </div>
                    <p class="mt-1 text-sm text-slate-400">Items overdue by 2 days or more</p>

                    <div class="mt-6 grid gap-6 lg:grid-cols-2">
                        {{-- Reports not printed for 2+ days --}}
                        <article class="rounded-xl bg-white/5 p-5 ring-1 ring-white/10 backdrop-blur-sm">
                            <div class="mb-4 flex items-center justify-between">
                                <h3 class="text-sm font-semibold text-white">Reports not printed</h3>
                                <span class="rounded-full bg-amber-500/10 px-2.5 py-1 text-xs font-medium text-amber-300">
                                    {{ $unprintedReports->total() }}
                                </span>
                            </div>
                            @if ($unprintedReports->isEmpty())
                                <p class="text-sm text-slate-400">No reports waiting to be printed.</p>
                            @else
                                <ul class="divide-y divide-white/10">
                                    @foreach ($unprintedReports as $report)
                                        <li class="py-3 first:pt-0 last:pb-0">
                                            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                                <div>
                                                    <p class="text-sm font-medium text-white">
                                                        {{ $report->patient?->name ?? 'Unknown patient' }}
                                                    </p>
                                                    <p class="text-xs text-slate-400">
                                                        {{ $report->test?->name ?? 'Unknown test' }}
                                                        &bull;
                                                        MR #{{ $report->patient?->created_at?->format('d-m-Y') ?? '—' }}-{{ $report->patient_id }}
                                                    </p>
                                                </div>
                                                <div class="mt-2 flex items-center gap-3 sm:mt-0">
                                                    <span class="text-xs font-medium text-rose-300">
                                                        {{ ceil($report->updated_at->diffInDays(now())) }} days
                                                    </span>
                                                    <a href="{{ route('invoice', $report->patient_id) }}"
                                                        wire:navigate
                                                        class="text-xs font-medium text-cyan-300 hover:text-cyan-200">
                                                        Invoice
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('admin.reports.mark-printed', $report) }}"
                                                        class="inline-flex items-center gap-1.5"
                                                        title="Mark as printed">
                                                        @csrf
                                                        <input
                                                            type="checkbox"
                                                            id="print-{{ $report->id }}"
                                                            onchange="this.form.submit()"
                                                            class="h-4 w-4 cursor-pointer rounded border-slate-600 bg-slate-700 text-cyan-500 focus:ring-cyan-500/50"
                                                        >
                                                        <label for="print-{{ $report->id }}" class="cursor-pointer text-xs text-slate-400">Printed</label>
                                                    </form>
                                                    <a href="{{ route('showreport', $report->id) }}"
                                                        target="_blank"
                                                        class="text-xs font-medium text-cyan-300 hover:text-cyan-200">
                                                        Print
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mt-4">
                                    {{ $unprintedReports->onEachSide(1)->links('vendor.pagination.dark') }}
                                </div>
                            @endif
                        </article>

                        {{-- Results not added for 2+ days --}}
                        <article class="rounded-xl bg-white/5 p-5 ring-1 ring-white/10 backdrop-blur-sm">
                            <div class="mb-4 flex items-center justify-between">
                                <h3 class="text-sm font-semibold text-white">Results not added</h3>
                                <span class="rounded-full bg-rose-500/10 px-2.5 py-1 text-xs font-medium text-rose-300">
                                    {{ $missingResults->total() }}
                                </span>
                            </div>
                            @if ($missingResults->isEmpty())
                                <p class="text-sm text-slate-400">No pending results.</p>
                            @else
                                <ul class="divide-y divide-white/10">
                                    @foreach ($missingResults as $item)
                                        <li class="py-3 first:pt-0 last:pb-0">
                                            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                                <div>
                                                    <p class="text-sm font-medium text-white">
                                                        {{ $item->patient?->name ?? 'Unknown patient' }}
                                                    </p>
                                                    <p class="text-xs text-slate-400">
                                                        {{ $item->test?->name ?? 'Unknown test' }}
                                                        &bull;
                                                        MR #{{ $item->patient?->created_at?->format('d-m-Y') ?? '—' }}-{{ $item->patient_id }}
                                                    </p>
                                                </div>
                                                <div class="mt-2 flex items-center gap-3 sm:mt-0">
                                                    <span class="text-xs font-medium text-rose-300">
                                                        {{ ceil($item->created_at->diffInDays(now())) }} days
                                                    </span>
                                                    <a href="{{ route('invoice', $item->patient_id) }}"
                                                        wire:navigate
                                                        class="text-xs font-medium text-cyan-300 hover:text-cyan-200">
                                                        Invoice
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('admin.reports.mark-result-added', $item) }}"
                                                        class="inline-flex items-center gap-1.5"
                                                        title="Mark result as added">
                                                        @csrf
                                                        <input
                                                            type="checkbox"
                                                            id="result-added-{{ $item->id }}"
                                                            onchange="this.form.submit()"
                                                            class="h-4 w-4 cursor-pointer rounded border-slate-600 bg-slate-700 text-cyan-500 focus:ring-cyan-500/50"
                                                        >
                                                        <label for="result-added-{{ $item->id }}" class="cursor-pointer text-xs text-slate-400">Added</label>
                                                    </form>
                                                    @if ($item->test_id)
                                                        <a href="{{ route('addResults', ['patientId' => $item->patient_id, 'testId' => $item->test_id]) }}"
                                                            wire:navigate
                                                            class="text-xs font-medium text-cyan-300 hover:text-cyan-200">
                                                            Add result
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mt-4">
                                    {{ $missingResults->onEachSide(1)->links('vendor.pagination.dark') }}
                                </div>
                            @endif
                        </article>
                    </div>
                </section>
            @endif

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
                    <a
                        href="{{ route('reports.index') }}"
                        wire:navigate
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/25 bg-white/5 px-6 py-3.5 text-sm font-semibold text-white shadow-sm backdrop-blur-sm transition hover:bg-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-300 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900"
                    >
                        <svg class="h-5 w-5 text-cyan-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                        </svg>
                        Reports
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
