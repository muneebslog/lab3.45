<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_test_id',
        'test_field_id',
        'result',
    ];





    public function patientTest()
    {
        return $this->belongsTo(PatientTest::class);
    }

    public function testField()
    {
        return $this->belongsTo(TestField::class);
    }

}
