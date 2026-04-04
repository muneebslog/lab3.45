<?php

namespace App\Livewire;

use App\Models\Patient;
use Livewire\Component;

class PatientEdit extends Component
{
    public $name;
    public $age;
    public $reciept;
    public $phone;
    public $gender;
    public $doctor;
    public $patient;

    public function mount(Patient $id)
    {
        $this->patient = $id;
        $this->name = $this->patient->name;
        $this->age = $this->patient->age;
        $this->phone = $this->patient->phone;
        $this->gender = $this->patient->gender;
        $this->reciept = $this->patient->receipt_no;
        $this->doctor = $this->patient->doctor;
    }

    public function update()
    {
        // Validate inputs
        $this->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:0',
            'gender' => 'required|string',
            'reciept' => 'nullable|max:255',
        ]);

        // Update the patient
        $res=$this->patient->update([
            'name' => $this->name,
            'age' => $this->age,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'receipt_no' => $this->reciept,
            'doctor' => $this->doctor,
        ]);
        if($res){
            return redirect()->route('cases-list');

        }

        // Optionally, add a success message or redirect
        session()->flash('message', 'Patient updated successfully!');
    }

    public function render()
    {
        return view('livewire.patient-edit');
    }
}
