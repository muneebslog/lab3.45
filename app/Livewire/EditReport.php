<?php

namespace App\Livewire;

use App\Models\PatientTest;
use App\Models\TestResult;
use Livewire\Component;

class EditReport extends Component
{
    public $patientId;

    public $testId;

    public $pivot;

    public $patient;

    public $test;

    public $testResults;

    public $results;

    // public function mount($patientId, $testId)
    // {
    //     $this->patientId = $patientId;
    //     $this->testId = $testId;

    //     $this->pivot = PatientTest::where('patient_id', $patientId)
    //         ->where('test_id', $testId)
    //         ->with('test', 'patient', 'testResults')
    //         ->first();
    //     $this->patient = $this->pivot->patient;
    //     $this->test = $this->pivot->test;
    //     $this->testResults = $this->pivot->testResults;

    //     // Initialize results array
    //     $this->results = [];

    //     // Loop through each test field
    //     foreach ($this->test->testFields as $testField) {
    //         // Find the result for the current test field
    //         $result = $this->testResults->firstWhere('test_field_id', $testField->id);
    //         // Set the result value or default to null if not found
    //         $this->results[$testField->id] = $result ? $result->result : null;
    //     }
    // }
    public function mount($patientId, $testId)
    {
        $this->patientId = $patientId;
        $this->testId = $testId;

        $this->pivot = PatientTest::where('patient_id', $patientId)
            ->where('test_id', $testId)
            ->with('test', 'patient', 'testResults')
            ->first();
        $this->patient = $this->pivot->patient;
        $this->test = $this->pivot->test;
        $this->testResults = $this->pivot->testResults;

        // Initialize results array
        $this->results = [];

        // Loop through each test field
        foreach ($this->test->testFields as $testField) {
            // Find the result for the current test field
            $result = $this->testResults->firstWhere('test_field_id', $testField->id);

            // Check if the test field has normal ranges and if multiple ranges is 1
            if ($testField->multiple_ranges == 1) {
                // Fetch the gender-specific normal range
                $range = $testField->normalRanges->where('gender', $this->patient->gender)->first();

                // If no gender-specific range, use the "all" range
                if (! $range) {
                    $range = $testField->normalRanges->where('gender', 'all')->first();
                }

                // Assign the range values if found
                if ($range) {
                    $testField->min_value = $range->min_value;
                    $testField->max_value = $range->max_value;
                }
            }

            // Set the result value or default to null if not found
            $this->results[$testField->id] = $result ? $result->result : null;
        }
    }

    public function save()
    {
        if (! auth()->user()?->isAdmin()) {
            abort(403);
        }

        foreach ($this->results as $testFieldId => $resultValue) {
            // Check if result is an array and handle it appropriately
            if (is_array($resultValue)) {
                $resultValue = json_encode($resultValue);
            }

            // Apply transformation rules to result values
            if (is_string($resultValue)) {
                $trimmed = trim($resultValue);
                $lower = strtolower($trimmed);
                if (in_array($lower, ['nil', 'nill'], true)) {
                    $resultValue = 'Nil';
                } elseif (strlen($trimmed) === 1) {
                    if ($trimmed === 'n') {
                        $resultValue = 'Nil';
                    } elseif ($trimmed === 'N') {
                        $resultValue = 'Negative';
                    } elseif (strtoupper($trimmed) === 'P') {
                        $resultValue = 'Positive';
                    }
                }
            }
            switch ($resultValue) {
                case 'W':
                    $resultValue = 'Whool Blood';
                    break;
                case 'Compatible':
                case 'compatible':
                    $resultValue = " Donor Cells are Compatible With Patient's Serum";
                    break;
            }

            // Find the existing result or create a new one if it doesn't exist
            $result = TestResult::where('patient_test_id', $this->pivot->id)
                ->where('test_field_id', $testFieldId)
                ->first();

            if ($result) {
                // Update the existing result
                $result->update(['result' => $resultValue]);
            } else {
                // Create a new result if it doesn't exist
                TestResult::create([
                    'patient_test_id' => $this->pivot->id,
                    'test_field_id' => $testFieldId,
                    'result' => $resultValue,
                ]);
            }
        }

        return redirect()->route('invoice', $this->patientId);
    }

    public function render()
    {
        return view('livewire.edit-report');
    }
}
