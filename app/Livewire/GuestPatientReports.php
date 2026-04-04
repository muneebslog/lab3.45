<?php

namespace App\Livewire;

use App\Models\Patient;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest-results')]
class GuestPatientReports extends Component
{
    public string $phone = '';

    public ?string $lookupDigits = null;

    public ?string $lookupPhoneRaw = null;

    public function search(): void
    {
        $this->validate([
            'phone' => ['required', 'string', 'min:10', 'max:20'],
        ]);

        $raw = trim($this->phone);
        $digits = preg_replace('/\D+/', '', $raw);

        if (strlen($digits) < 10) {
            $this->addError('phone', 'Enter a valid phone number (at least 10 digits).');

            return;
        }

        $this->lookupPhoneRaw = $raw;
        $this->lookupDigits = $digits;
        session(['guest_lab_verified_phone_digits' => $digits]);
    }

    #[Computed]
    public function visits(): Collection
    {
        if ($this->lookupDigits === null || $this->lookupDigits === '') {
            return collect();
        }

        $digits = $this->lookupDigits;
        $raw = $this->lookupPhoneRaw ?? '';

        return Patient::query()
            ->guestPhoneLookup($digits, $raw !== '' ? $raw : null)
            ->with('tests')
            ->orderByDesc('created_at')
            ->get();
    }

    public function render()
    {
        return view('livewire.guest-patient-reports');
    }
}
