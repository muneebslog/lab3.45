<?php

namespace App\Livewire;

use App\Models\PatientTest;
use App\Models\TestResult;
use Livewire\Component;

class ShowReport extends Component
{
    public $data;
    public $id;
    public function mount($id){
        $this->id=$id;
        $data=PatientTest::with('patient','test','testResults')->find($id);
        // dd($data->id);
        // $results=TestResult::where('patient_test_id',$data->id)->get();
        // dd($data->test->code);
        $this->data=$data;
        // $this->hi();
        // dd($data);
        // dd($data->patient->gender);

    }
    public function hi(){
        PatientTest::find($this->id)->update([
            'isResultAdded'=>1
        ]);
    }
    public function render()
    {
        return view('livewire.show-report')->layout('invoices.letterpad');
    }
}
