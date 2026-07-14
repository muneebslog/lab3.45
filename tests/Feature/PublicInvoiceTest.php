<?php

use App\Models\Patient;
use App\Models\Test;

test('public invoice page displays patient by receipt number', function () {
    $test = Test::create([
        'name' => 'Complete Blood Count',
        'code' => '1300',
        'price' => 500,
    ]);

    $patient = Patient::create([
        'name' => 'John Doe',
        'gender' => 'male',
        'age' => 30,
        'age_unit' => 'Year',
        'phone' => '03001234567',
        'doctor' => 'Self',
        'receipt_no' => 140720261001,
    ]);

    $patient->tests()->attach($test->id);

    $response = $this->get('/public/invoice/140720261001');

    $response->assertOk()
        ->assertSee('John Doe')
        ->assertSee('Complete Blood Count');

    $patient->tests()->detach();
    $patient->delete();
    $test->delete();
});

test('public invoice page returns 404 for unknown receipt number', function () {
    $response = $this->get('/public/invoice/999999999999');

    $response->assertNotFound();
});
