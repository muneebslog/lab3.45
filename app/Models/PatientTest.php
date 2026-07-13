<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTest extends Model
{
    protected $table="patient_test";
    use HasFactory;
    protected $fillable=[
        'isResultAdded','isPrinted','printed_at'
    ];

    protected $casts=[
        'isResultAdded'=>'boolean',
        'isPrinted'=>'boolean',
        'printed_at'=>'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class, 'patient_test_id');
    }

    /**
     * Mark this patient test as printed if results have been added.
     */
    public function markAsPrinted(): void
    {
        if (! $this->isResultAdded) {
            return;
        }

        $this->update([
            'isPrinted' => 1,
            'printed_at' => now(),
        ]);
    }
}
