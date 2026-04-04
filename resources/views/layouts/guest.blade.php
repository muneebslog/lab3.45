<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>[x-cloak]{display:none!important}</style>
    </head>
    <body class="min-h-screen antialiased text-slate-800" style="font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;">
        <div class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden px-5 py-10 sm:px-8">
            <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-cyan-950" aria-hidden="true"></div>
            <div class="pointer-events-none absolute -top-32 -right-32 h-96 w-96 rounded-full bg-cyan-500/15 blur-3xl" aria-hidden="true"></div>
            <div class="pointer-events-none absolute -bottom-48 -left-24 h-[28rem] w-[28rem] rounded-full bg-teal-400/10 blur-3xl" aria-hidden="true"></div>
            <div class="pointer-events-none absolute inset-0 opacity-[0.35] [background-image:linear-gradient(rgba(255,255,255,0.06)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.06)_1px,transparent_1px)] [background-size:48px_48px]" aria-hidden="true"></div>

            <div class="relative z-10 w-full max-w-md">
                <a href="{{ url('/') }}" wire:navigate class="mb-8 flex flex-col items-center gap-3 transition hover:opacity-90">
                    <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/10 text-cyan-300 ring-1 ring-white/20 backdrop-blur-sm">
                        <x-application-logo class="h-8 w-8 fill-current" />
                    </span>
                    <span class="text-center">
                        <span class="block text-sm font-semibold tracking-tight text-white">{{ config('app.name', 'Laboratory') }}</span>
                        <span class="text-xs text-cyan-100/70">Pathology information system</span>
                    </span>
                </a>

                <div class="rounded-2xl border border-white/20 bg-white/95 p-8 shadow-2xl shadow-slate-900/20 ring-1 ring-slate-200/80 backdrop-blur-md sm:p-9">
                    {{ $slot }}
                </div>

                <p class="mt-8 text-center text-xs text-slate-400">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. Authorized access only.
                </p>
            </div>
        </div>
    </body>
</html>
