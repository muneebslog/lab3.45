<div class="rounded-2xl bg-white/95 p-6 shadow-xl ring-1 ring-slate-200/80 backdrop-blur-sm sm:p-8">
    <h1 class="text-2xl font-bold tracking-tight text-slate-900">Look up your visits</h1>
    <p class="mt-2 text-sm leading-relaxed text-slate-600">
        Enter the phone number you used when your sample was registered. Tap a visit to open your invoice; from there you can open finalized reports with the lab letterhead when they are ready.
    </p>

    <form class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-end" wire:submit="search">
        <div class="min-w-0 flex-1">
            <label for="guest-phone" class="block text-xs font-semibold uppercase tracking-wide text-slate-500">Phone number</label>
            <input
                id="guest-phone"
                type="tel"
                inputmode="tel"
                autocomplete="tel"
                wire:model="phone"
                placeholder="e.g. 03001234567"
                class="mt-1.5 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/20"
            />
            @error('phone')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <button
            type="submit"
            class="inline-flex shrink-0 items-center justify-center rounded-xl bg-gradient-to-r from-cyan-600 to-teal-600 px-6 py-3 text-sm font-semibold text-white shadow-md transition hover:from-cyan-500 hover:to-teal-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-400 focus-visible:ring-offset-2"
            wire:loading.attr="disabled"
            wire:target="search"
        >
            <span wire:loading.remove wire:target="search">Find visits</span>
            <span wire:loading wire:target="search">Searching…</span>
        </button>
    </form>

    @if ($this->lookupDigits !== null)
        @if ($this->visits->isEmpty())
            <div class="mt-8 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900">
                No visits were found for this number. Check the digits or contact the lab if you need help.
            </div>
        @else
            <div class="mt-8">
                <p class="text-sm font-medium text-slate-700">
                    <span class="font-semibold text-slate-900">{{ $this->visits->count() }}</span>
                    {{ $this->visits->count() === 1 ? 'visit' : 'visits' }} found — tap to open invoice
                </p>

                <ul class="mt-4 space-y-3" role="list">
                    @foreach ($this->visits as $visit)
                        <li wire:key="guest-visit-{{ $visit->id }}">
                            <a
                                href="{{ route('guest.invoice', $visit) }}"
                                wire:navigate
                                class="flex w-full items-center justify-between gap-3 overflow-hidden rounded-xl border border-slate-200 bg-white px-4 py-4 text-left shadow-sm transition hover:border-cyan-300/60 hover:bg-cyan-50/40 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-400 focus-visible:ring-offset-2"
                            >
                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-900 capitalize">{{ $visit->name }}</p>
                                    <p class="mt-0.5 text-xs text-slate-500">
                                        Medical record # {{ $visit->created_at->format('d-m-Y') }}-{{ $visit->id }}
                                        · {{ $visit->created_at->format('d M Y, g:i A') }}
                                    </p>
                                    <p class="mt-1 text-xs text-slate-500">
                                        {{ $visit->tests->count() }} {{ $visit->tests->count() === 1 ? 'test' : 'tests' }}
                                    </p>
                                </div>
                                <span class="shrink-0 text-cyan-700" aria-hidden="true">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endif
</div>
