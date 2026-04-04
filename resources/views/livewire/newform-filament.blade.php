<div class="p-4">

    <x-back-link href="{{ route('dashboard') }}">New Case</x-back-link>

    <form class=" max-w-[50vw] mx-auto m-3 p-2 border rounded" wire:submit="create">
        {{ $this->form }}

        <div class="flex w-full items-center justify-end">
            <button type="submit" wire:loading.attr="disabled" class=" absolute right-[14%] bottom-2 py-2 m-3 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 focus:outline-none focus:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none">
                Submit
            </button>
        </div>
    </form>

    <x-filament-actions::modals />
</div>
