<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <header class="mb-8 text-center sm:text-left">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
            {{ __('Sign in') }}
        </h1>
        <p class="mt-2 text-sm leading-relaxed text-slate-600">
            {{ __('Use your staff credentials to access the lab dashboard.') }}
        </p>
    </header>

    <x-auth-session-status class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800" :status="session('status')" />

    <form wire:submit="login" class="space-y-5">
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-700" />
            <x-text-input
                wire:model="form.email"
                id="email"
                class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50/80 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-cyan-500 focus:ring-cyan-500/30"
                type="email"
                name="email"
                required
                autofocus
                autocomplete="username"
                placeholder="name@organization.org"
            />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <div x-data="{ showPassword: false }">
            <x-input-label for="password" :value="__('Password')" class="text-slate-700" />

            <div class="relative mt-2">
                <x-text-input
                    wire:model="form.password"
                    id="password"
                    x-bind:type="showPassword ? 'text' : 'password'"
                    class="block w-full rounded-xl border-slate-200 bg-slate-50/80 py-2.5 pe-12 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-cyan-500 focus:ring-cyan-500/30"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                />
                <button
                    type="button"
                    class="absolute end-2 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-lg text-slate-500 transition hover:bg-slate-100 hover:text-slate-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500/40"
                    x-on:click="showPassword = !showPassword"
                    x-bind:aria-pressed="showPassword"
                    x-bind:aria-label="showPassword ? '{{ __('Hide password') }}' : '{{ __('Show password') }}'"
                >
                    <svg x-show="!showPassword" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg x-cloak x-show="showPassword" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <label for="remember" class="inline-flex cursor-pointer items-center gap-2.5">
                <input
                    wire:model="form.remember"
                    id="remember"
                    type="checkbox"
                    class="h-4 w-4 rounded border-slate-300 text-cyan-600 shadow-sm focus:ring-cyan-500/40"
                    name="remember"
                >
                <span class="text-sm text-slate-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a
                    class="text-sm font-medium text-cyan-700 underline decoration-cyan-300 underline-offset-2 transition hover:text-cyan-800 hover:decoration-cyan-500"
                    href="{{ route('password.request') }}"
                    wire:navigate
                >
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button class="flex w-full items-center justify-center gap-2 rounded-xl border-0 bg-gradient-to-r from-cyan-500 to-teal-500 py-3 text-sm font-semibold normal-case tracking-normal text-slate-900 shadow-lg shadow-cyan-900/15 transition hover:from-cyan-400 hover:to-teal-400 focus:ring-cyan-500/40 focus:ring-offset-2">
                {{ __('Log in') }}
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </x-primary-button>
        </div>
    </form>
</div>
