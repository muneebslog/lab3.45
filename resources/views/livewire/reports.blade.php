<div class="reports-root relative min-h-[calc(100dvh-4.5rem)] w-full overflow-x-hidden bg-[#0c1222] text-slate-100 antialiased">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=syne:600,700,800|dm-sans:400,500,600,700&display=swap" rel="stylesheet" />

    @php
        $rangeFrom = \Carbon\Carbon::parse($dateFrom);
        $rangeTo = \Carbon\Carbon::parse($dateTo);
        $rangeLabel = $rangeFrom->toDateString() === $rangeTo->toDateString()
            ? ($rangeFrom->isToday() ? 'Today' : $rangeFrom->format('d F Y'))
            : $rangeFrom->format('d M Y') . ' – ' . $rangeTo->format('d M Y');
        $totalShown = count($reports);
    @endphp

    <div
        class="pointer-events-none absolute inset-0 bg-gradient-to-b from-[#0c1222] via-[#0f172a] to-[#0a1628]"
        aria-hidden="true"
    ></div>
    <div
        class="pointer-events-none absolute -top-40 right-0 h-[32rem] w-[32rem] rounded-full bg-cyan-500/[0.07] blur-[100px]"
        aria-hidden="true"
    ></div>
    <div
        class="pointer-events-none absolute bottom-0 -left-32 h-[28rem] w-[28rem] rounded-full bg-emerald-500/[0.06] blur-[90px]"
        aria-hidden="true"
    ></div>
    <div
        class="pointer-events-none absolute inset-0 opacity-[0.4] [background-image:linear-gradient(rgba(255,255,255,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.04)_1px,transparent_1px)] [background-size:56px_56px]"
        aria-hidden="true"
    ></div>
    <div
        class="pointer-events-none absolute inset-0 opacity-[0.03] [background-image:url('data:image/svg+xml,%3Csvg viewBox=%220 0 256 256%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22n%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.8%22 numOctaves=%224%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23n)%22/%3E%3C/svg%3E')]"
        aria-hidden="true"
    ></div>

    <div
        class="relative z-10 mx-auto max-w-[90rem] px-4 py-10 sm:px-6 lg:px-10 lg:py-14"
        style="font-family: 'DM Sans', ui-sans-serif, system-ui, sans-serif;"
    >
        {{-- Page header --}}
        <header class="report-enter flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-2xl">
                <p
                    class="mb-3 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] px-3 py-1 text-[0.65rem] font-semibold uppercase tracking-[0.2em] text-cyan-200/90 backdrop-blur-md"
                >
                    <span class="h-1 w-1 rounded-full bg-cyan-400 shadow-[0_0_10px_rgba(34,211,238,0.7)]" aria-hidden="true"></span>
                    Reports
                </p>
                <h1
                    class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-[2.75rem] lg:leading-[1.1]"
                    style="font-family: 'Syne', 'DM Sans', sans-serif;"
                >
                    Test
                    <span class="bg-gradient-to-r from-cyan-200 via-teal-200 to-emerald-200 bg-clip-text text-transparent">reports</span>
                </h1>
                <p class="mt-3 max-w-lg text-pretty text-sm leading-relaxed text-slate-400 sm:text-base">
                    Search tests directly by result date and test type. Showing
                    <span class="font-semibold text-slate-200">{{ $rangeLabel }}</span>.
                </p>
            </div>
            <div class="flex flex-col items-start gap-3 sm:flex-row sm:items-center">
                <div
                    class="inline-flex items-baseline gap-2 rounded-2xl border border-white/10 bg-white/[0.03] px-5 py-3 backdrop-blur-md"
                >
                    <span class="text-2xl font-bold tabular-nums text-white lg:text-3xl" style="font-family: 'Syne', sans-serif;">{{ $totalShown }}</span>
                    <span class="text-xs font-medium uppercase tracking-wider text-slate-500">tests</span>
                </div>
                <a
                    href="{{ route('cases-list') }}"
                    wire:navigate
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/25 bg-white/5 px-5 py-3 text-sm font-semibold text-white shadow-sm backdrop-blur-sm transition hover:bg-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[#0f172a]"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    Case list
                </a>
            </div>
        </header>

        {{-- Filters --}}
        <div
            class="report-enter mt-10 rounded-2xl border border-white/10 bg-white/[0.04] p-5 shadow-xl shadow-black/20 backdrop-blur-xl sm:p-6"
            style="animation-delay: 0.06s"
        >
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-12 lg:items-end lg:gap-5">
                <div class="lg:col-span-2">
                    <label for="report-date-from" class="mb-1.5 block text-[0.65rem] font-semibold uppercase tracking-wider text-slate-500">Result date from</label>
                    <input
                        id="report-date-from"
                        type="date"
                        wire:model.live="dateFrom"
                        class="w-full rounded-xl border border-white/10 bg-[#0b1220]/80 px-3 py-2.5 text-sm text-slate-100 shadow-inner shadow-black/20 outline-none transition placeholder:text-slate-600 focus:border-cyan-500/50 focus:ring-2 focus:ring-cyan-500/25"
                    />
                </div>
                <div class="lg:col-span-2">
                    <label for="report-date-to" class="mb-1.5 block text-[0.65rem] font-semibold uppercase tracking-wider text-slate-500">Result date to</label>
                    <input
                        id="report-date-to"
                        type="date"
                        wire:model.live="dateTo"
                        class="w-full rounded-xl border border-white/10 bg-[#0b1220]/80 px-3 py-2.5 text-sm text-slate-100 shadow-inner shadow-black/20 outline-none transition focus:border-cyan-500/50 focus:ring-2 focus:ring-cyan-500/25"
                    />
                </div>
                <div class="lg:col-span-4">
                    <label for="report-search" class="mb-1.5 block text-[0.65rem] font-semibold uppercase tracking-wider text-slate-500">Test type</label>
                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-500" aria-hidden="true">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </span>
                        <input
                            id="report-search"
                            type="search"
                            wire:model.live.debounce.300ms="search"
                            placeholder="e.g. CBC, code or short name"
                            class="w-full rounded-xl border border-white/10 bg-[#0b1220]/80 py-2.5 pl-10 pr-3 text-sm text-slate-100 shadow-inner shadow-black/20 outline-none transition focus:border-cyan-500/50 focus:ring-2 focus:ring-cyan-500/25 placeholder:text-slate-600"
                        />
                    </div>
                </div>
                <div class="lg:col-span-3">
                    <label for="report-status" class="mb-1.5 block text-[0.65rem] font-semibold uppercase tracking-wider text-slate-500">Status</label>
                    <select
                        id="report-status"
                        wire:model.live="status"
                        class="w-full rounded-xl border border-white/10 bg-[#0b1220]/80 px-3 py-2.5 text-sm text-slate-100 shadow-inner shadow-black/20 outline-none transition focus:border-cyan-500/50 focus:ring-2 focus:ring-cyan-500/25"
                    >
                        <option value="all">All tests</option>
                        <option value="completed">Completed</option>
                        <option value="printed">Printed</option>
                        <option value="pending">Pending results</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Table card --}}
        <div
            class="report-enter mt-8 overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03] shadow-2xl shadow-black/30 backdrop-blur-xl"
            style="animation-delay: 0.12s"
        >
            <div class="-mx-px overflow-x-auto">
                <table class="min-w-[980px] w-full border-collapse text-left">
                    <thead>
                        <tr class="border-b border-white/10 bg-white/[0.02]">
                            <th scope="col" class="px-5 py-4 text-[0.65rem] font-bold uppercase tracking-[0.14em] text-slate-500 lg:pl-8">Patient</th>
                            <th scope="col" class="px-5 py-4 text-[0.65rem] font-bold uppercase tracking-[0.14em] text-slate-500">Record #</th>
                            <th scope="col" class="px-5 py-4 text-[0.65rem] font-bold uppercase tracking-[0.14em] text-slate-500">Test</th>
                            <th scope="col" class="px-5 py-4 text-[0.65rem] font-bold uppercase tracking-[0.14em] text-slate-500">Result date</th>
                            <th scope="col" class="px-5 py-4 text-[0.65rem] font-bold uppercase tracking-[0.14em] text-slate-500">Status</th>
                            <th scope="col" class="px-5 py-4 text-end text-[0.65rem] font-bold uppercase tracking-[0.14em] text-slate-500 lg:pr-8">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/[0.06]">
                        @forelse ($reports as $report)
                            @php
                                $patient = $report->patient;
                                $test = $report->test;
                                $hasResult = $report->isResultAdded;
                                $isPrinted = $report->isPrinted;
                            @endphp
                            <tr class="group transition-colors duration-200 hover:bg-white/[0.04]">
                                <td class="px-5 py-4 align-middle lg:pl-8">
                                    <a href="{{ route('invoice', $report->patient_id) }}" wire:navigate class="flex items-center gap-3 outline-none focus-visible:ring-2 focus-visible:ring-cyan-400/50 rounded-lg -m-1 p-1">
                                        <span
                                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-white/10 bg-gradient-to-br from-cyan-500/20 to-teal-600/10 text-sm font-bold text-cyan-100 shadow-inner shadow-black/20 ring-1 ring-white/5 transition group-hover:border-cyan-400/30 group-hover:from-cyan-400/25"
                                            style="font-family: 'Syne', sans-serif;"
                                        >
                                            {{ strtoupper(substr($patient->name ?? '?', 0, 1)) }}
                                        </span>
                                        <div class="min-w-0">
                                            <span class="block truncate text-sm font-semibold capitalize text-white group-hover:text-cyan-100">{{ $patient->name ?? 'Unknown' }}</span>
                                            <span class="block truncate text-xs text-slate-500 group-hover:text-slate-400">{{ $patient->phone ?? '—' }}</span>
                                        </div>
                                    </a>
                                </td>
                                <td class="px-5 py-4 align-middle">
                                    <a href="{{ route('invoice', $report->patient_id) }}" wire:navigate class="block font-mono text-sm text-slate-300 tabular-nums transition hover:text-cyan-200">
                                        {{ $patient->created_at?->format('d-m-Y') ?? '—' }}-{{ $report->patient_id }}
                                    </a>
                                </td>
                                <td class="px-5 py-4 align-middle">
                                    <span class="block text-sm font-medium text-white">{{ $test->name ?? 'Unknown test' }}</span>
                                    @if (filled($test->code ?? null))
                                        <span class="block text-xs font-mono text-slate-500">{{ $test->code }}</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 align-middle">
                                    @if ($hasResult)
                                        <span class="text-sm text-slate-400 tabular-nums">{{ $report->updated_at->format('d M Y') }}</span>
                                        <span class="block text-xs text-slate-600">{{ $report->updated_at->format('h:i A') }}</span>
                                    @else
                                        <span class="text-sm text-slate-500">—</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 align-middle">
                                    @if ($hasResult)
                                        @if ($isPrinted)
                                            <span class="inline-flex items-center gap-1.5 rounded-full border border-blue-500/25 bg-blue-500/10 px-2.5 py-1 text-xs font-semibold text-blue-200">
                                                <svg class="h-3.5 w-3.5 text-blue-400" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                                                    <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                                </svg>
                                                Printed
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-500/25 bg-emerald-500/10 px-2.5 py-1 text-xs font-semibold text-emerald-200">
                                                <svg class="h-3.5 w-3.5 text-emerald-400" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                </svg>
                                                Completed
                                            </span>
                                        @endif
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-amber-500/30 bg-amber-500/10 px-2.5 py-1 text-xs font-semibold text-amber-100">
                                            <svg class="h-3.5 w-3.5 text-amber-400" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </svg>
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 align-middle lg:pr-8">
                                    <div class="flex flex-wrap items-center justify-end gap-2">
                                        @if ($hasResult)
                                            <a
                                                href="{{ route('showreport', $report->id) }}"
                                                target="_blank"
                                                class="rounded-lg border border-white/10 bg-white/[0.04] px-3 py-1.5 text-xs font-semibold text-cyan-200 transition hover:border-cyan-400/40 hover:bg-cyan-500/10 hover:text-cyan-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-400/50"
                                            >
                                                Header
                                            </a>
                                            <a
                                                href="{{ route('noheaderreport', $report->id) }}"
                                                target="_blank"
                                                class="rounded-lg border border-white/10 bg-white/[0.04] px-3 py-1.5 text-xs font-semibold text-slate-300 transition hover:border-white/20 hover:bg-white/[0.06] hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white/30"
                                            >
                                                No Header
                                            </a>
                                            @if (auth()->user()?->isAdmin())
                                                <a
                                                    href="{{ route('editreport', ['patientId' => $report->patient_id, 'testId' => $report->test_id]) }}"
                                                    wire:navigate
                                                    class="rounded-lg px-3 py-1.5 text-xs font-semibold text-slate-400 transition hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white/30"
                                                >
                                                    Edit
                                                </a>
                                            @endif
                                        @else
                                            @if (auth()->user()?->isAdmin())
                                                <a
                                                    href="{{ route('addResults', ['patientId' => $report->patient_id, 'testId' => $report->test_id]) }}"
                                                    wire:navigate
                                                    class="rounded-lg border border-white/10 bg-white/[0.04] px-3 py-1.5 text-xs font-semibold text-cyan-200 transition hover:border-cyan-400/40 hover:bg-cyan-500/10 hover:text-cyan-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-400/50"
                                                >
                                                    Add Result
                                                </a>
                                            @endif
                                        @endif
                                        <a
                                            href="{{ route('invoice', $report->patient_id) }}"
                                            wire:navigate
                                            class="rounded-lg px-3 py-1.5 text-xs font-semibold text-slate-400 transition hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white/30"
                                        >
                                            Invoice
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-20 text-center">
                                    <div class="mx-auto max-w-md">
                                        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl border border-white/10 bg-white/[0.04] text-slate-500">
                                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.25" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V19.5a2.25 2.25 0 0 0 2.25 2.25h.75m3-.75h.008v.008h-.008v-.008Zm0-2.25h.008v.008h-.008v-.008Zm-3 2.25h.008v.008h-.008v-.008Zm0-2.25h.008v.008h-.008v-.008Z" />
                                            </svg>
                                        </div>
                                        <p class="text-lg font-semibold text-white" style="font-family: 'Syne', sans-serif;">No reports found</p>
                                        <p class="mt-2 text-sm text-slate-500">Try widening the result date range, clearing the test search, or changing the status filter.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <footer class="flex flex-col gap-2 border-t border-white/10 bg-white/[0.02] px-5 py-4 sm:flex-row sm:items-center sm:justify-between lg:px-8">
                <p class="text-sm text-slate-500">
                    <span class="font-semibold tabular-nums text-slate-300">{{ $totalShown }}</span>
                    {{ $totalShown === 1 ? 'test' : 'tests' }} in view
                </p>
                <p class="text-xs text-slate-600">Pathology reports · {{ config('app.name', 'Laboratory') }}</p>
            </footer>
        </div>
    </div>

    <style>
        .report-enter {
            animation: report-enter 0.7s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        @keyframes report-enter {
            from {
                opacity: 0;
                transform: translateY(14px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @media (prefers-reduced-motion: reduce) {
            .report-enter {
                animation: none;
                opacity: 1;
                transform: none;
            }
        }
    </style>
</div>
