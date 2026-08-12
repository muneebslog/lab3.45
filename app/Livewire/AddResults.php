<?php

namespace App\Livewire;

use App\Models\Patient;
use App\Models\PatientTest;
use App\Models\Test;
use App\Models\TestResult;
use Livewire\Component;

class AddResults extends Component
{
    public $patient;

    public $patient_id = '';

    public $test_id = '';

    public $results = [];

    public $error;

    // public function mount($patientId, $testId)
    // {
    //     $this->patient = Patient::with(['tests' => function ($query) use ($testId) {
    //         $query->wherePivot('isResultAdded', 0)->where('test_id', $testId);
    //     }, 'tests.testFields.normalRanges'])->findOrFail($patientId);

    //     $this->test_id = $testId;
    //     $this->patient_id = $patientId;

    //     // Fetch the test fields and normal ranges based on gender only if multiple_ranges is 1
    //     foreach ($this->patient->tests as $test) {
    //         foreach ($test->testFields as $field) {
    //             // Check if the field has multiple ranges
    //             if ($field->multiple_ranges == 1) {
    //                 // Fetch the range for the patient's gender
    //                 $range = $field->normalRanges->where('gender', $this->patient->gender)->first();

    //                 // If no gender-specific range, use the "all" range
    //                 if (!$range) {
    //                     $range = $field->normalRanges->where('gender', 'all')->first();
    //                 }

    //                 // Assign min and max from the normal ranges table
    //                 $field->min_value = $range->min_value;
    //                 $field->max_value = $range->max_value;
    //             } else {
    //                 // Use the min and max directly from the fields table
    //                 $field->min_value = $field->min_value; // Already in the field table
    //                 $field->max_value = $field->max_value; // Already in the field table
    //             }
    //         }
    //     }
    // }

    public function mount($patientId, $testId)
    {
        $this->patient = Patient::with(['tests' => function ($query) use ($testId) {
            $query->wherePivot('isResultAdded', 0)->where('test_id', $testId);
        }, 'tests.testFields.normalRanges'])->findOrFail($patientId);

        $this->test_id = $testId;
        $this->patient_id = $patientId;

        // Define the custom order for test fields if test code is 2831
        $testFieldMapping = [
            // Patient / Donor Information
            114 => 'Patient Blood Group',
            106 => 'RH Factor',
            105 => 'Donor Name',
            107 => 'Age/Sex',
            109 => 'Blood Product',
            118 => 'Cross Match Result',

            // Donor’s Tests
            68 => 'HbsAg',
            67 => 'Anti HCV',
            100 => 'HIV',
            111 => 'VDRL',
            84 => 'M.P',
        ];

        foreach ($this->patient->tests as $test) {
            // Sort fields only if test code is 2831
            if ($test->code == 2831) {
                $test->testFields = $test->testFields->sortBy(function ($field) use ($testFieldMapping) {
                    return array_search($field->id, array_keys($testFieldMapping));
                })->values(); // Reindex the collection after sorting
            }

            foreach ($test->testFields as $field) {
                // Check if the field has multiple ranges
                if ($field->multiple_ranges == 1) {
                    // Fetch the range for the patient's gender
                    $range = $field->normalRanges->where('gender', $this->patient->gender)->first();

                    // If no gender-specific range, use the "all" range
                    if (! $range) {
                        $range = $field->normalRanges->where('gender', 'all')->first();
                    }

                    // Assign min and max from the normal ranges table
                    $field->min_value = $range?->min_value;
                    $field->max_value = $range?->max_value;
                } else {
                    // Use the min and max directly from the fields table
                    $field->min_value = $field->min_value;
                    $field->max_value = $field->max_value;
                }
            }
        }
    }

    public function save()
    {
        if (! auth()->user()?->isAdmin()) {
            abort(403);
        }

        foreach ($this->results as $testCode => $array) {
            $data = PatientTest::where('patient_id', $this->patient->id)
                ->where('test_id', $testCode)->first(); // Use first() instead of get()[0]

            if (! $data) {
                continue; // Handle case where no data is found
            }

            $patient_test_id = $data->id;

            foreach ($array as $test_field_id => $result) {
                // Prevent duplicate entries if the user clicks save more than once.
                if (TestResult::where('patient_test_id', $patient_test_id)
                    ->where('test_field_id', $test_field_id)
                    ->exists()) {
                    continue;
                }

                // Check if result is an array and handle it appropriately
                if (is_array($result)) {
                    // Convert the array to JSON string or handle it in another way
                    $result = json_encode($result);
                }
                if (is_string($result)) {
                    $trimmed = trim($result);
                    $lower = strtolower($trimmed);
                    if (in_array($lower, ['nil', 'nill'], true)) {
                        $result = 'Nil';
                    } elseif (strlen($trimmed) === 1) {
                        if ($trimmed === 'n') {
                            $result = 'Nil';
                        } elseif ($trimmed === 'N') {
                            $result = 'Negative';
                        } elseif (strtoupper($trimmed) === 'P') {
                            $result = 'Positive';
                        }
                    }
                }
                if ($result === 'W') {
                    $result = 'Whool Blood';
                } elseif ($result === 'Compatible' || $result === 'compatible') {
                    $result = " Donor Cells are Compatible With Patient's Serum";
                }
                TestResult::create([
                    'patient_test_id' => $patient_test_id,
                    'test_field_id' => $test_field_id,
                    'result' => $result,
                ]);
            }

            // Update the PatientTest after inserting all results
            $data->update([
                'isResultAdded' => 1,
                // Add other fields if needed
            ]);
        }

        return redirect()->route('invoice', ['id' => $this->patient_id]);
    }

    public function render()
    {
        return view('livewire.add-results');
    }
}
