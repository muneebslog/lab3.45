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

    public function mount(Patient $patient): void
    {
        $allowed = false;
        if (request()->hasValidSignature()) {
            $allowed = true;
        } else {
            $digits = session('guest_lab_verified_phone_digits');
            if (is_string($digits) && strlen($digits) >= 10) {
                $allowed = Patient::query()
                    ->whereKey($patient->id)
                    ->guestPhoneLookup($digits)
                    ->exists();
            }
        }

        abort_unless($allowed, 404);

        $this->patient = $patient->load('tests');
        $this->total = (int) $this->patient->tests->sum('price');
    }

    public function render()
    {
        return view('livewire.guest-invoice');
    }
}
