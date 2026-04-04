<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PatientTest;

class NoHeaderShowReport extends Component
{
    public $data;
    public $resultCount;
    public function mount($id)
    {
        $data = PatientTest::with('patient', 'test', 'testResults')->find($id);
        $this->data = $data;

        // Filter out the test results that have an empty result
        $data->testResults = $data->testResults->filter(function ($res) {
            return !empty($res->result);
        });

        // Find the ESR index
        $esrIndex = null;
        foreach ($data->testResults as $i => $res) {
            if ($res->testField->field_name == "ESR") {
                $esrIndex = $i;
                break;
            }
        }

        // Check if ESR is not in the 9th position (index 8)
        if ($esrIndex !== null && $esrIndex !== 8) {
            $esrItem = $data->testResults->splice($esrIndex, 1)->first(); // Remove ESR from its current position
            $data->testResults->splice(8, 0, [$esrItem]); // Insert ESR at index 8 (9th position)
        }

        // Update the result count after filtering
        $this->resultCount = count($data->testResults);

        // Debug the position of ESR to ensure it's at index 8
        // foreach ($data->testResults as $i => $res) {
        //     if ($res->testField->field_name == "ESR") {
        //         dd($i); // Should output 8 if ESR is in the correct position
        //     }
        // }
    }


    public function hi(){
        PatientTest::find(24)->update([
            'isResultAdded'=>1
        ]);
    }
    public function render()
    {
        return view('livewire.no-header-show-report')->layout('invoices.noheader');
    }
}
