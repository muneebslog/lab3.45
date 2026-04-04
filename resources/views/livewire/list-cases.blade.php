<div class="case-list-root relative min-h-[calc(100dvh-4.5rem)] w-full overflow-x-hidden bg-[#0c1222] text-slate-100 antialiased">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=syne:600,700,800|dm-sans:400,500,600,700&display=swap" rel="stylesheet" />

    @php
        $rangeFrom = \Carbon\Carbon::parse($dateFrom);
        $rangeTo = \Carbon\Carbon::parse($dateTo);
        $rangeLabel = $rangeFrom->toDateString() === $rangeTo->toDateString()
            ? ($rangeFrom->isToday() ? 'Today' : $rangeFrom->format('d F Y'))
            : $rangeFrom->format('d M Y') . ' – ' . $rangeTo->format('d M Y');
        $totalShown = count($patients);
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
        <header class="case-list-enter flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-2xl">
                <p
                    class="mb-3 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] px-3 py-1 text-[0.65rem] font-semibold uppercase tracking-[0.2em] text-cyan-200/90 backdrop-blur-md"
                >
                    <span class="h-1 w-1 rounded-full bg-cyan-400 shadow-[0_0_10px_rgba(34,211,238,0.7)]" aria-hidden="true"></span>
                    Registry
                </p>
                <h1
                    class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-[2.75rem] lg:leading-[1.1]"
                    style="font-family: 'Syne', 'DM Sans', sans-serif;"
                >
                    Case
                    <span class="bg-gradient-to-r from-cyan-200 via-teal-200 to-emerald-200 bg-clip-text text-transparent">list</span>
                </h1>
                <p class="mt-3 max-w-lg text-pretty text-sm leading-relaxed text-slate-400 sm:text-base">
                    Filter by date, search by name or phone, and open invoices or edit patient records. Showing
                    <span class="font-semibold text-slate-200">{{ $rangeLabel }}</span>.
                </p>
            </div>
            <div class="flex flex-col items-start gap-3 sm:flex-row sm:items-center">
                <div
                    class="inline-flex items-baseline gap-2 rounded-2xl border border-white/10 bg-white/[0.03] px-5 py-3 backdrop-blur-md"
                >
                    <span class="text-2xl font-bold tabular-nums text-white lg:text-3xl" style="font-family: 'Syne', sans-serif;">{{ $totalShown }}</span>
                    <span class="text-xs font-medium uppercase tracking-wider text-slate-500">cases</span>
                </div>
                <a
                    href="{{ route('new-case') }}"
                    wire:navigate
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-cyan-500 to-teal-500 px-5 py-3 text-sm font-semibold text-slate-950 shadow-lg shadow-cyan-950/40 transition hover:from-cyan-400 hover:to-teal-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-300 focus-visible:ring-offset-2 focus-visible:ring-offset-[#0f172a]"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    New case
                </a>
            </div>
        </header>

        {{-- Filters --}}
        <div
            class="case-list-enter mt-10 rounded-2xl border border-white/10 bg-white/[0.04] p-5 shadow-xl shadow-black/20 backdrop-blur-xl sm:p-6"
            style="animation-delay: 0.06s"
        >
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-12 lg:items-end lg:gap-5">
                <div class="lg:col-span-2">
                    <label for="case-date-from" class="mb-1.5 block text-[0.65rem] font-semibold uppercase tracking-wider text-slate-500">From</label>
                    <input
                        id="case-date-from"
                        type="date"
                        wire:model.live="dateFrom"
                        class="w-full rounded-xl border border-white/10 bg-[#0b1220]/80 px-3 py-2.5 text-sm text-slate-100 shadow-inner shadow-black/20 outline-none transition placeholder:text-slate-600 focus:border-cyan-500/50 focus:ring-2 focus:ring-cyan-500/25"
                    />
                </div>
                <div class="lg:col-span-2">
                    <label for="case-date-to" class="mb-1.5 block text-[0.65rem] font-semibold uppercase tracking-wider text-slate-500">To</label>
                    <input
                        id="case-date-to"
                        type="date"
                        wire:model.live="dateTo"
                        class="w-full rounded-xl border border-white/10 bg-[#0b1220]/80 px-3 py-2.5 text-sm text-slate-100 shadow-inner shadow-black/20 outline-none transition focus:border-cyan-500/50 focus:ring-2 focus:ring-cyan-500/25"
                    />
                </div>
                <div class="lg:col-span-4">
                    <label for="case-search" class="mb-1.5 block text-[0.65rem] font-semibold uppercase tracking-wider text-slate-500">Search</label>
                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-500" aria-hidden="true">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </span>
                        <input
                            id="case-search"
                            type="search"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Name or phone"
                            class="w-full rounded-xl border border-white/10 bg-[#0b1220]/80 py-2.5 pl-10 pr-3 text-sm text-slate-100 shadow-inner shadow-black/20 outline-none transition focus:border-cyan-500/50 focus:ring-2 focus:ring-cyan-500/25 placeholder:text-slate-600"
                        />
                    </div>
                </div>
                <div class="flex items-center lg:col-span-3">
                    <label class="flex cursor-pointer select-none items-center gap-3 rounded-xl border border-white/5 bg-white/[0.02] px-4 py-3 transition hover:border-white/10 hover:bg-white/[0.04]">
                        <input
                            type="checkbox"
                            wire:model.live="pendingOnly"
                            class="h-4 w-4 rounded border-white/20 bg-[#0b1220] text-cyan-500 shadow-sm focus:ring-cyan-500/40 focus:ring-offset-0 focus:ring-offset-transparent"
                        />
                        <span class="text-sm font-medium text-slate-300">Pending tests only</span>
                    </label>
                </div>
            </div>
        </div>

        {{-- Table card --}}
        <div
            class="case-list-enter mt-8 overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03] shadow-2xl shadow-black/30 backdrop-blur-xl"
            style="animation-delay: 0.12s"
        >
            <div class="-mx-px overflow-x-auto">
                <table class="min-w-[920px] w-full border-collapse text-left">
                    <thead>
                        <tr class="border-b border-white/10 bg-white/[0.02]">
                            <th scope="col" class="px-5 py-4 text-[0.65rem] font-bold uppercase tracking-[0.14em] text-slate-500 lg:pl-8">Patient</th>
                            <th scope="col" class="px-5 py-4 text-[0.65rem] font-bold uppercase tracking-[0.14em] text-slate-500">Record #</th>
                            <th scope="col" class="px-5 py-4 text-[0.65rem] font-bold uppercase tracking-[0.14em] text-slate-500">Status</th>
                            <th scope="col" class="px-5 py-4 text-[0.65rem] font-bold uppercase tracking-[0.14em] text-slate-500">Portfolio</th>
                            <th scope="col" class="px-5 py-4 text-[0.65rem] font-bold uppercase tracking-[0.14em] text-slate-500">Registered</th>
                            <th scope="col" class="px-5 py-4 text-end text-[0.65rem] font-bold uppercase tracking-[0.14em] text-slate-500 lg:pr-8">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/[0.06]">
                        @forelse ($patients as $item)
                            @php
                                $countIsResultAdded = $item->tests
                                    ->filter(function ($test) {
                                        return $test->pivot->isResultAdded == 1;
                                    })
                                    ->count();
                                $totalTests = count($item->tests);
                                $bar = $totalTests == 0 ? 100 : ($countIsResultAdded / $totalTests) * 100;
                            @endphp
                            <tr class="group transition-colors duration-200 hover:bg-white/[0.04]">
                                <td class="px-5 py-4 align-middle lg:pl-8">
                                    <a href="{{ route('invoice', $item->id) }}" wire:navigate class="flex items-center gap-3 outline-none focus-visible:ring-2 focus-visible:ring-cyan-400/50 rounded-lg -m-1 p-1">
                                        <span
                                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-white/10 bg-gradient-to-br from-cyan-500/20 to-teal-600/10 text-sm font-bold text-cyan-100 shadow-inner shadow-black/20 ring-1 ring-white/5 transition group-hover:border-cyan-400/30 group-hover:from-cyan-400/25"
                                            style="font-family: 'Syne', sans-serif;"
                                        >
                                            {{ strtoupper(substr($item->name, 0, 1)) }}
                                        </span>
                                        <div class="min-w-0">
                                            <span class="block truncate text-sm font-semibold capitalize text-white group-hover:text-cyan-100">{{ $item->name }}</span>
                                            <span class="block truncate text-xs text-slate-500 group-hover:text-slate-400">{{ $item->phone }}</span>
                                        </div>
                                    </a>
                                </td>
                                <td class="px-5 py-4 align-middle">
                                    <a href="{{ route('invoice', $item->id) }}" wire:navigate class="block font-mono text-sm text-slate-300 tabular-nums transition hover:text-cyan-200">
                                        {{ $item->created_at->format('d-m-Y') }}-{{ $item->id }}
                                    </a>
                                </td>
                                <td class="px-5 py-4 align-middle">
                                    <a href="{{ route('invoice', $item->id) }}" wire:navigate class="inline-flex">
                                        @if ($countIsResultAdded == $totalTests)
                                            <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-500/25 bg-emerald-500/10 px-2.5 py-1 text-xs font-semibold text-emerald-200">
                                                <svg class="h-3.5 w-3.5 text-emerald-400" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                </svg>
                                                Complete
                                            </span>
                                        @elseif ($countIsResultAdded != $totalTests && $countIsResultAdded != 0)
                                            <span class="inline-flex items-center gap-1.5 rounded-full border border-amber-500/30 bg-amber-500/10 px-2.5 py-1 text-xs font-semibold text-amber-100">
                                                <svg class="h-3.5 w-3.5 text-amber-400" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                </svg>
                                                {{ $totalTests - $countIsResultAdded }} pending
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 rounded-full border border-rose-500/30 bg-rose-500/10 px-2.5 py-1 text-xs font-semibold text-rose-100">
                                                <svg class="h-3.5 w-3.5 text-rose-400" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                </svg>
                                                Awaiting results
                                            </span>
                                        @endif
                                    </a>
                                </td>
                                <td class="px-5 py-4 align-middle">
                                    <a href="{{ route('invoice', $item->id) }}" wire:navigate class="flex min-w-[7rem] items-center gap-3">
                                        <span class="text-xs font-medium tabular-nums text-slate-500">{{ $countIsResultAdded }}/{{ $totalTests }}</span>
                                        <div class="h-2 flex-1 max-w-[6rem] overflow-hidden rounded-full bg-white/10 ring-1 ring-white/5">
                                            <div
                                                class="h-full rounded-full bg-gradient-to-r from-cyan-400 to-teal-400 transition-all duration-500"
                                                style="width: {{ $bar }}%"
                                                role="progressbar"
                                                aria-valuenow="{{ (int) round($bar) }}"
                                                aria-valuemin="0"
                                                aria-valuemax="100"
                                            ></div>
                                        </div>
                                    </a>
                                </td>
                                <td class="px-5 py-4 align-middle">
                                    <a href="{{ route('invoice', $item->id) }}" wire:navigate class="text-sm text-slate-400 tabular-nums transition hover:text-slate-200">
                                        {{ $item->created_at->format('d M Y') }}
                                    </a>
                                </td>
                                <td class="px-5 py-4 align-middle lg:pr-8">
                                    <div class="flex flex-wrap items-center justify-end gap-2">
                                        <a
                                            href="{{ route('invoice', $item->id) }}"
                                            wire:navigate
                                            class="rounded-lg border border-white/10 bg-white/[0.04] px-3 py-1.5 text-xs font-semibold text-cyan-200 transition hover:border-cyan-400/40 hover:bg-cyan-500/10 hover:text-cyan-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-400/50"
                                        >
                                            Open
                                        </a>
                                        <a
                                            href="{{ route('patientEdit', $item->id) }}"
                                            wire:navigate
                                            class="rounded-lg px-3 py-1.5 text-xs font-semibold text-slate-400 transition hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white/30"
                                        >
                                            Edit
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
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-lg font-semibold text-white" style="font-family: 'Syne', sans-serif;">No cases in this range</p>
                                        <p class="mt-2 text-sm text-slate-500">Try widening the dates, clearing search, or turning off “pending only”.</p>
                                        <a
                                            href="{{ route('new-case') }}"
                                            wire:navigate
                                            class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-cyan-300 hover:text-cyan-200"
                                        >
                                            Register a new case
                                            <span aria-hidden="true">→</span>
                                        </a>
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
                    {{ $totalShown === 1 ? 'case' : 'cases' }} in view
                </p>
                <p class="text-xs text-slate-600">Pathology registry · {{ config('app.name', 'Laboratory') }}</p>
            </footer>
        </div>
    </div>

    <style>
        .case-list-enter {
            animation: case-list-enter 0.7s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        .case-row {
            animation: case-list-enter 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        @keyframes case-list-enter {
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
            .case-list-enter {
                animation: none;
                opacity: 1;
                transform: none;
            }
        }
    </style>
</div>
