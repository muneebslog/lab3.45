<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Your reports — {{ config('app.name', 'Laboratory') }}</title>
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

            <div class="relative z-10 mx-auto max-w-3xl px-5 py-10 sm:px-8 lg:px-10">
                <header class="mb-8 flex flex-wrap items-center justify-between gap-4">
                    <a href="{{ url('/') }}" wire:navigate class="text-sm font-medium text-cyan-100/90 hover:text-white transition">
                        ← Back to home
                    </a>
                </header>
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
