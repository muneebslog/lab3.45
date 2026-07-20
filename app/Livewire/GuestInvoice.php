<?php

namespace App\Livewire;

use App\Models\Patient;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest-invoice')]
class GuestInvoice extends Component
{
    public Patient $patient;

    public int $total = 0;

    public function mount(string $invoice_number): void
    {
        $this->patient = Patient::query()
            ->where('receipt_no', $invoice_number)
            ->with('tests')
            ->firstOrFail();

        $this->total = (int) $this->patient->tests->sum('price');
    }

    public function render()
    {
        return view('livewire.guest-invoice');
    }
}
