<?php

use App\Models\Patient;
use App\Models\Test;
use App\Models\User;
use Illuminate\Support\Facades\URL;

test('authenticated users can open print-all pdf for completed reports', function () {
    $user = User::factory()->create();

    $patient = Patient::create([
        'name' => 'Print All Patient',
        'gender' => 'male',
        'age' => 40,
        'age_unit' => 'Year',
        'phone' => '03001112233',
        'doctor' => 'Self',
        'receipt_no' => 160820261001,
    ]);

    $ready = Test::create([
        'name' => 'Ready Test',
        'code' => 'RDY1',
        'price' => 500,
    ]);
    $pending = Test::create([
        'name' => 'Pending Test',
        'code' => 'PND1',
        'price' => 300,
    ]);

    $patient->tests()->attach($ready->id, ['isResultAdded' => 1]);
    $patient->tests()->attach($pending->id, ['isResultAdded' => 0]);

    $response = $this->actingAs($user)->get(route('report.pdf.all', $patient));

    $response->assertOk()
        ->assertHeader('content-type', 'application/pdf');

    expect($response->headers->get('content-disposition'))->toContain('inline');

    $patient->refresh();
    $printed = $patient->tests()->where('tests.id', $ready->id)->first();
    expect((bool) $printed->pivot->isPrinted)->toBeTrue();

    $patient->tests()->detach();
    $patient->delete();
    $ready->delete();
    $pending->delete();
});

test('print-all returns 404 when no completed reports exist', function () {
    $user = User::factory()->create();

    $patient = Patient::create([
        'name' => 'No Results Patient',
        'gender' => 'female',
        'age' => 22,
        'age_unit' => 'Year',
        'phone' => '03004445566',
        'doctor' => 'Self',
        'receipt_no' => 160820261002,
    ]);

    $test = Test::create([
        'name' => 'Pending Only',
        'code' => 'PND2',
        'price' => 200,
    ]);

    $patient->tests()->attach($test->id, ['isResultAdded' => 0]);

    $this->actingAs($user)
        ->get(route('report.pdf.all', $patient))
        ->assertNotFound();

    $patient->tests()->detach();
    $patient->delete();
    $test->delete();
});

test('guest can download all completed reports with a signed url', function () {
    $patient = Patient::create([
        'name' => 'Guest Download Patient',
        'gender' => 'male',
        'age' => 33,
        'age_unit' => 'Year',
        'phone' => '03007778899',
        'doctor' => 'Self',
        'receipt_no' => 160820261003,
    ]);

    $test = Test::create([
        'name' => 'Guest Ready Test',
        'code' => 'GRDY',
        'price' => 700,
    ]);

    $patient->tests()->attach($test->id, ['isResultAdded' => 1]);

    $url = URL::signedRoute('guest.reports.pdf.all', [
        'invoice_number' => $patient->receipt_no,
    ]);

    $response = $this->get($url);

    $response->assertOk()
        ->assertHeader('content-type', 'application/pdf');

    expect($response->headers->get('content-disposition'))->toContain('attachment');

    $this->get(route('guest.invoice', $patient->receipt_no))
        ->assertOk()
        ->assertSee('Download All');

    $patient->tests()->detach();
    $patient->delete();
    $test->delete();
});

test('guest download-all rejects unsigned urls', function () {
    $patient = Patient::create([
        'name' => 'Unsigned Guest Patient',
        'gender' => 'male',
        'age' => 28,
        'age_unit' => 'Year',
        'phone' => '03001231231',
        'doctor' => 'Self',
        'receipt_no' => 160820261004,
    ]);

    $this->get(route('guest.reports.pdf.all', [
        'invoice_number' => $patient->receipt_no,
    ]))->assertForbidden();

    $patient->delete();
});
