<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Pathology laboratory — accurate diagnostics and secure test reports.">

        <title>{{ config('app.name', 'Laboratory') }} — Pathology Lab</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen antialiased text-slate-800 bg-slate-50" style="font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;">
        <div class="relative min-h-screen overflow-hidden">
            <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-cyan-950" aria-hidden="true"></div>
            <div class="pointer-events-none absolute -top-32 -right-32 h-96 w-96 rounded-full bg-cyan-500/15 blur-3xl" aria-hidden="true"></div>
            <div class="pointer-events-none absolute -bottom-48 -left-24 h-[28rem] w-[28rem] rounded-full bg-teal-400/10 blur-3xl" aria-hidden="true"></div>
            <div class="pointer-events-none absolute inset-0 opacity-[0.35] [background-image:linear-gradient(rgba(255,255,255,0.06)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.06)_1px,transparent_1px)] [background-size:48px_48px]" aria-hidden="true"></div>

            <div class="relative z-10 mx-auto flex min-h-screen max-w-6xl flex-col px-5 pb-12 pt-10 sm:px-8 lg:px-10">
                <header class="flex shrink-0 items-center gap-4">
                    <div class="flex items-center gap-3">
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/10 text-cyan-300 ring-1 ring-white/20 backdrop-blur-sm">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div>
                            <p class="text-sm font-semibold tracking-tight text-white">{{ config('app.name', 'Laboratory') }}</p>
                            <p class="text-xs text-cyan-100/70">Pathology information system</p>
                        </div>
                    </div>
                </header>

                <main class="flex flex-1 flex-col justify-center py-14 lg:py-20">
                    <div class="mx-auto w-full max-w-xl text-center lg:mx-0 lg:max-w-2xl lg:text-left">
                        <p class="mb-4 inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-medium text-cyan-100 ring-1 ring-white/15 backdrop-blur-sm">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.8)]" aria-hidden="true"></span>
                            Clinical diagnostics &amp; reporting
                        </p>
                        <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-5xl lg:leading-[1.1]">
                            Precision pathology for
                            <span class="bg-gradient-to-r from-cyan-200 to-teal-200 bg-clip-text text-transparent"> clearer care decisions</span>
                        </h1>
                        <p class="mt-5 max-w-xl text-pretty text-base leading-relaxed text-slate-300 lg:mx-0 mx-auto">
                            Manage cases, capture results, and deliver dependable lab reports from one place—built for accuracy, traceability, and everyday lab workflows.
                        </p>

                        <div class="mt-10 flex flex-col items-stretch gap-3 sm:flex-row sm:items-center sm:justify-center lg:justify-start">
                            <a
                                href="{{ route('guest.patient-reports') }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/25 bg-white/5 px-6 py-3.5 text-sm font-semibold text-white shadow-sm backdrop-blur-sm transition hover:bg-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-300 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900"
                            >
                                <svg class="h-5 w-5 text-cyan-200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                See your reports
                            </a>
                            @if (Route::has('login'))
                                <a
                                    href="{{ route('login') }}"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-cyan-500 to-teal-500 px-6 py-3.5 text-sm font-semibold text-slate-900 shadow-lg shadow-cyan-900/30 transition hover:from-cyan-400 hover:to-teal-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-300 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900"
                                >
                                    Log in
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path d="M13 7l5 5m0 0l-5 5m5-5H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            @endif
                        </div>

                        <ul class="mt-12 grid gap-4 sm:grid-cols-3 lg:max-w-2xl" role="list">
                            <li class="rounded-xl bg-white/5 p-4 text-left ring-1 ring-white/10 backdrop-blur-sm">
                                <p class="text-sm font-semibold text-white">Quality-first</p>
                                <p class="mt-1 text-xs leading-relaxed text-slate-400">Structured workflows for consistent reporting.</p>
                            </li>
                            <li class="rounded-xl bg-white/5 p-4 text-left ring-1 ring-white/10 backdrop-blur-sm">
                                <p class="text-sm font-semibold text-white">Secure access</p>
                                <p class="mt-1 text-xs leading-relaxed text-slate-400">Staff sign-in for sensitive patient data.</p>
                            </li>
                            <li class="rounded-xl bg-white/5 p-4 text-left ring-1 ring-white/10 backdrop-blur-sm sm:col-span-1">
                                <p class="text-sm font-semibold text-white">Full traceability</p>
                                <p class="mt-1 text-xs leading-relaxed text-slate-400">From order to finalized report.</p>
                            </li>
                        </ul>
                    </div>
                </main>

                <footer class="mt-auto border-t border-white/10 pt-8 text-center text-xs text-slate-500 lg:text-left">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laboratory') }}. All rights reserved.</p>
                </footer>
            </div>
        </div>
    </body>
</html>
