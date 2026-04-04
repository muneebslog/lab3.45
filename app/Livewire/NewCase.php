<?php

namespace App\Livewire;

use App\Models\Test;
use App\Models\Patient;
use Livewire\Attributes\Validate;
use Livewire\Component;

class NewCase extends Component
{
    public $name;
    public $total=0;
    public $age;
    public $gender='male';
    #[Validate('required|min:10')]
    public $phone=0;

    public $param;

    public $tests = [];


    public function findTest()
    {
      $param = $this->param;

      $test = Test::where(function ($query) use ($param) {
        $query->where('code', $param)
              ->orWhere('short_hand', $param);
      })->first();  // Don't use firstOrFail()
      $this->param='';
      if (isset($test)) {
        // Add the new test if it doesn't already exist by ID
        $foundDuplicate = false;
        foreach ($this->tests as $existingTest) {
          if ($existingTest['id'] === $test->id) {
            $foundDuplicate = true;
            break;
          }
        }

        if (!$foundDuplicate) {
          $this->tests[] = [
            'id' => $test->id,
            'name' => $test->name,
            'code' => $test->code,
            'short_hand' => $test->short_hand,
            'price'=>$test->price
          ];
          $this->updateTotalPrice();
        }
      } else {
        $this->dispatch('error','Cant FInd This Test In Data Base');
      $this->param='';
      }

      return $test ?? null;  // Optionally return the retrieved test or null if not found
    }

    public function save()
{
    $this->validate();
    if (!empty($this->tests)) {

        $patient = Patient::create([
            'name' => $this->name,
            'age' => $this->age,
            'phone' => $this->phone,
            'gender' => $this->gender,
        ]);
        // dd($patient);

        $testIds = array_column($this->tests, 'id');
        dd($testIds);
        $patient->tests()->attach($testIds);
        $this->rest();
        $this->redirect('/invoice/'.$patient->id); // Pass patient ID // Return the created patient for further use (optional)

    } else {
        $this->dispatch('error','Test Not  Selected');
        // You could log a message, throw an exception, or take other actions
    }

}
public function rest(){
    $this->reset();
}

public function updateTotalPrice()
{
    // Calculate total price based on test prices
    $this->total = array_reduce($this->tests, function ($total, $test) {
        return $total + $test['price'];
    }, 0); // Initialize with 0 for empty array
}

public function delTest($id)
{
    $filteredTests = array_filter($this->tests, function ($test) use ($id) {
        return $test['id'] !== $id; // Keep only elements where ID doesn't match
    });

    $this->tests = $filteredTests; // Update the tests array
    $this->updateTotalPrice();

    // Optional: return the updated array (if needed)
    return $this->tests;
}


    public function render()
    {
        return view('livewire.new-case');
    }
}
