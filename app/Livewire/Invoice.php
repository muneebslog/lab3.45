<?php

namespace App\Livewire;

use App\Models\Patient;
use App\Models\Test;
use Livewire\Component;

class Invoice extends Component
{
    public $qr;

    public $total = 0;

    public $test;

    public $testField = false;

    public $patient;

    public $tests;

    public function mount($id)
    {

        $this->tests = Test::all();
        $data = Patient::with('tests')->findOrFail($id);
        $this->patient = $data;

        // Calculate total based on tests associated with the patient
        foreach ($data->tests as $test) {
            $this->total += $test->price;
        }
    }

    public function getData()
    {
        $data = Patient::with('tests')->findOrFail($this->patient->id);
        $this->patient = $data;

        // Recalculate the total
        $this->total = 0; // Reset total before recalculating
        foreach ($data->tests as $test) {
            $this->total += $test->price;
        }
    }

    public function add()
    {
        if (! auth()->user()?->isAdmin()) {
            abort(403);
        }

        // Attach the selected test to the patient's tests
        $test = Test::find($this->test);
        $this->patient->tests()->attach($test);
        $this->getData();
    }

    public function delTest($id)
    {
        if (! auth()->user()?->isAdmin()) {
            abort(403);
        }

        // Detach the test from the patient's tests
        $this->patient->tests()->detach($id);

        // Recalculate the total after deleting the test
        $this->getData();
    }

    public function render()
    {
        return view('livewire.invoice');
    }
}
