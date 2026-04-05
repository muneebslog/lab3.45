<div>
    <div class="mx-auto max-w-lg px-4 sm:max-w-2xl sm:px-6 lg:px-8">
        <article class="overflow-hidden rounded-2xl bg-white shadow-[0_25px_50px_-12px_rgba(15,23,42,0.25)] ring-1 ring-slate-200/60 dark:bg-neutral-900 dark:ring-neutral-700">
            <div class="h-1 bg-gradient-to-r from-teal-600 via-cyan-600 to-sky-700" aria-hidden="true"></div>

            <div class="px-5 py-6 sm:px-8 sm:py-8">
                {{-- Brand + QR --}}
                <header class="flex gap-5 sm:gap-6">
                    <div class="min-w-0 flex-1">
                        <p class="text-[0.65rem] font-semibold uppercase tracking-[0.22em] text-teal-800/90 dark:text-teal-300/90">
                            Clinical Laboratory
                        </p>
                        <h1
                            class="mt-1 text-[2.35rem] font-semibold leading-[1.05] tracking-tight text-slate-900 sm:text-[2.75rem] dark:text-white"
                            style="font-family: 'Fraunces', Georgia, 'Times New Roman', serif;"
                        >
                            Mohsin
                        </h1>
                        <p class="mt-3 max-w-[16rem] text-sm leading-relaxed text-slate-600 dark:text-neutral-400">
                            Official visit summary for your records. Thank you for choosing our lab.
                        </p>
                    </div>
                    <div
                        class="shrink-0 rounded-xl border border-slate-200/90 bg-slate-50 p-2.5 shadow-inner dark:border-neutral-600 dark:bg-neutral-800"
                        aria-label="Invoice link QR code"
                    >
                        {{ QrCode::size(72)->margin(1)->generate(\Illuminate\Support\Facades\URL::signedRoute('guest.invoice', ['patient' => $patient->id])) }}
                    </div>
                </header>

                {{-- Document title --}}
                <div class="mt-8 border-b border-slate-100 pb-6 dark:border-neutral-700">
                    <p class="text-[0.65rem] font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-neutral-500">Document</p>
                    <h2 class="mt-1 text-xl font-semibold text-slate-900 sm:text-2xl dark:text-neutral-100">Visit invoice</h2>
                </div>

                {{-- Patient details --}}
                <section class="mt-6" aria-labelledby="guest-invoice-patient-heading">
                    <h3 id="guest-invoice-patient-heading" class="text-[0.65rem] font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-neutral-500">
                        Patient &amp; visit
                    </h3>
                    <dl class="mt-3 grid gap-3 sm:grid-cols-2">
                        <div class="rounded-xl border border-slate-100 bg-slate-50/80 px-4 py-3.5 dark:border-neutral-700 dark:bg-neutral-800/50">
                            <dt class="text-[0.7rem] font-medium uppercase tracking-wide text-slate-500 dark:text-neutral-500">Medical record</dt>
                            <dd class="mt-1 font-mono text-sm font-semibold tabular-nums text-slate-900 dark:text-neutral-100">
                                {{ $patient->created_at->format('d-m-Y') }}-{{ $patient->id }}
                            </dd>
                        </div>
                        <div class="rounded-xl border border-slate-100 bg-slate-50/80 px-4 py-3.5 dark:border-neutral-700 dark:bg-neutral-800/50">
                            <dt class="text-[0.7rem] font-medium uppercase tracking-wide text-slate-500 dark:text-neutral-500">Full name</dt>
                            <dd class="mt-1 text-sm font-semibold text-slate-900 dark:text-neutral-100">{{ $patient->name }}</dd>
                        </div>
                        <div class="rounded-xl border border-slate-100 bg-slate-50/80 px-4 py-3.5 dark:border-neutral-700 dark:bg-neutral-800/50">
                            <dt class="text-[0.7rem] font-medium uppercase tracking-wide text-slate-500 dark:text-neutral-500">Gender</dt>
                            <dd class="mt-1 text-sm font-semibold capitalize text-slate-900 dark:text-neutral-100">{{ $patient->gender }}</dd>
                        </div>
                        <div class="rounded-xl border border-slate-100 bg-slate-50/80 px-4 py-3.5 dark:border-neutral-700 dark:bg-neutral-800/50">
                            <dt class="text-[0.7rem] font-medium uppercase tracking-wide text-slate-500 dark:text-neutral-500">Age</dt>
                            <dd class="mt-1 text-sm font-semibold tabular-nums text-slate-900 dark:text-neutral-100">{{ $patient->age }}</dd>
                        </div>
                        <div class="rounded-xl border border-slate-100 bg-slate-50/80 px-4 py-3.5 dark:border-neutral-700 dark:bg-neutral-800/50">
                            <dt class="text-[0.7rem] font-medium uppercase tracking-wide text-slate-500 dark:text-neutral-500">Invoice date</dt>
                            <dd class="mt-1 text-sm font-semibold text-slate-900 dark:text-neutral-100">{{ $patient->created_at->format('d F Y') }}</dd>
                        </div>
                        <div class="rounded-xl border border-slate-100 bg-slate-50/80 px-4 py-3.5 sm:col-span-2 dark:border-neutral-700 dark:bg-neutral-800/50">
                            <dt class="text-[0.7rem] font-medium uppercase tracking-wide text-slate-500 dark:text-neutral-500">Phone</dt>
                            <dd class="mt-1 text-sm font-semibold tabular-nums text-slate-900 dark:text-neutral-100">{{ $patient->phone }}</dd>
                        </div>
                    </dl>
                </section>

                {{-- Line items --}}
                <section class="mt-8" aria-labelledby="guest-invoice-services-heading">
                    <div class="flex items-end justify-between gap-3">
                        <h3 id="guest-invoice-services-heading" class="text-[0.65rem] font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-neutral-500">
                            Services &amp; charges
                        </h3>
                    </div>

                    <div class="mt-4 rounded-xl border border-slate-200/90 bg-slate-50/40 p-1 dark:border-neutral-600 dark:bg-neutral-800/30">
                        <div class="hidden grid-cols-12 gap-3 border-b border-slate-200/80 px-4 py-2.5 text-[0.65rem] font-semibold uppercase tracking-wider text-slate-500 sm:grid dark:border-neutral-600 dark:text-neutral-500">
                            <div class="col-span-6">Test</div>
                            <div class="col-span-2 text-end">Rate</div>
                            <div class="col-span-2">Status</div>
                            <div class="col-span-2 text-center">Reports</div>
                        </div>

                        <ul class="divide-y divide-slate-200/70 dark:divide-neutral-600">
                            @foreach ($patient->tests as $item)
                                <li class="p-4 sm:grid sm:grid-cols-12 sm:items-center sm:gap-3 sm:px-4 sm:py-3.5">
                                    <div class="sm:col-span-6">
                                        <p class="text-[0.65rem] font-semibold uppercase tracking-wider text-slate-400 sm:hidden dark:text-neutral-500">Test</p>
                                        <p class="text-[0.95rem] font-semibold leading-snug text-slate-900 dark:text-neutral-100">{{ $item->name }}</p>
                                    </div>

                                    <div class="mt-3 flex flex-wrap items-center gap-4 sm:col-span-6 sm:mt-0 sm:contents">
                                        <div class="sm:col-span-2 sm:text-end">
                                            <p class="text-[0.65rem] font-semibold uppercase tracking-wider text-slate-400 sm:hidden dark:text-neutral-500">Rate</p>
                                            <p class="text-sm font-semibold tabular-nums text-slate-900 dark:text-neutral-100">
                                                Rs {{ number_format((float) $item->price, 0, '.', ',') }}
                                            </p>
                                        </div>

                                        <div class="sm:col-span-2">
                                            <p class="text-[0.65rem] font-semibold uppercase tracking-wider text-slate-400 sm:hidden dark:text-neutral-500">Status</p>
                                            @if ($item->pivot->isResultAdded)
                                                <span
                                                    class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-800 ring-1 ring-emerald-200/60 dark:bg-emerald-950/40 dark:text-emerald-300 dark:ring-emerald-800/50"
                                                >
                                                    <span class="size-1.5 rounded-full bg-emerald-500" aria-hidden="true"></span>
                                                    Report ready
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700 ring-1 ring-slate-200/80 dark:bg-neutral-700/50 dark:text-neutral-200 dark:ring-neutral-600"
                                                >
                                                    <span class="size-1.5 rounded-full bg-amber-400" aria-hidden="true"></span>
                                                    In progress
                                                </span>
                                            @endif
                                        </div>

                                        <div class="flex w-full flex-wrap gap-2 sm:col-span-2 sm:w-auto sm:justify-center">
                                            <p class="w-full text-[0.65rem] font-semibold uppercase tracking-wider text-slate-400 sm:hidden dark:text-neutral-500">Reports</p>
                                            @if ($item->pivot->isResultAdded)
                                                <a
                                                    href="{{ \Illuminate\Support\Facades\URL::signedRoute('guest.report.show', ['patientTest' => $item->pivot->id]) }}"
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="inline-flex flex-1 items-center justify-center rounded-lg bg-teal-700 px-3 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-teal-800 sm:flex-initial"
                                                >
                                                    View report
                                                </a>
                                                <a
                                                    href="{{ \Illuminate\Support\Facades\URL::signedRoute('guest.report.pdf', ['patientTest' => $item->pivot->id]) }}"
                                                    class="inline-flex flex-1 items-center justify-center rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs font-semibold text-slate-800 shadow-sm transition hover:bg-slate-50 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100 dark:hover:bg-neutral-700 sm:flex-initial"
                                                >
                                                    Download PDF
                                                </a>
                                            @else
                                                <span class="text-sm text-slate-500 dark:text-neutral-400">Available when processing completes</span>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>

                {{-- Total --}}
                <footer class="mt-8 rounded-xl bg-slate-900 px-5 py-4 text-white dark:bg-neutral-950">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-[0.65rem] font-semibold uppercase tracking-[0.18em] text-slate-400">Total amount</p>
                            <p class="mt-0.5 text-xs text-slate-400">Including listed services</p>
                        </div>
                        <p class="text-2xl font-bold tabular-nums tracking-tight sm:text-[1.65rem]">Rs {{ number_format((float) $total, 0, '.', ',') }}</p>
                    </div>
                </footer>
            </div>
        </article>
    </div>
</div>
