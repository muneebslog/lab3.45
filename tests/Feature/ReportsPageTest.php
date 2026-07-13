<?php

use App\Models\Patient;
use App\Models\Test;
use App\Models\User;

it('renders the reports page for authenticated users', function () {
    $user = User::factory()->create();
    $patient = Patient::factory()->create(['name' => 'Test Patient']);
    $test = Test::factory()->create(['name' => 'Complete Blood Count', 'code' => 'CBC']);
    $patient->tests()->attach($test);

    $response = $this->actingAs($user)->get(route('reports.index'));

    $response->assertOk();
    $response->assertSee('Test reports');
    $response->assertSee('Test Patient');
    $response->assertSee('Complete Blood Count');
});

it('filters reports by test type search', function () {
    $user = User::factory()->create();
    $patient = Patient::factory()->create();

    $cbc = Test::factory()->create(['name' => 'Complete Blood Count', 'code' => 'CBC', 'short_hand' => 'CBC']);
    $lft = Test::factory()->create(['name' => 'Liver Function Test', 'code' => 'LFT']);

    $patient->tests()->attach([$cbc->id, $lft->id]);

    $response = $this->actingAs($user)->get(route('reports.index', ['search' => 'CBC']));

    $response->assertOk();
    $response->assertSee('Complete Blood Count');
    $response->assertDontSee('Liver Function Test');
});

it('shows pending and completed tests under all status', function () {
    $user = User::factory()->create();
    $patient = Patient::factory()->create();

    $testCompleted = Test::factory()->create(['name' => 'Completed Test']);
    $testPending = Test::factory()->create(['name' => 'Pending Test']);

    $patient->tests()->attach($testCompleted->id);
    $patient->tests()->attach($testPending->id);

    $patient->tests()
        ->where('tests.id', $testCompleted->id)
        ->updateExistingPivot($testCompleted->id, ['isResultAdded' => 1]);

    $response = $this->actingAs($user)->get(route('reports.index'));

    $response->assertOk();
    $response->assertSee('Completed Test');
    $response->assertSee('Pending Test');
});
