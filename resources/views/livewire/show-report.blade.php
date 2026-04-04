<div class="">
    <x-slot name="no">
        {{ $data->id }}

    </x-slot>

    @include('livewire.partials.report-body', ['data' => $data])
</div>
