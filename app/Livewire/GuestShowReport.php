<?php

namespace App\Livewire;

use App\Models\PatientTest;
use Livewire\Component;

class GuestShowReport extends Component
{
    public $data;

    public $id;

    public function mount(PatientTest $patientTest): void
    {
        abort_unless($patientTest->isResultAdded, 404);

        $this->id = $patientTest->id;
        $this->data = PatientTest::query()
            ->with(['patient', 'test', 'testResults'])
            ->findOrFail($patientTest->id);
    }

    public function render()
    {
        return view('livewire.show-report')->layout('invoices.letterpad');
    }
}
