<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestField extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_name',
        'unit',
        'multiple_ranges',
        'min_value',
        'max_value',
        'created_at',
        'updated_at',
    ];

    public function tests()
    {
        return $this->belongsToMany(Test::class);
    }

    public function patientTests()
    {
        return $this->hasManyThrough(PatientTest::class, TestResult::class, 'test_field_id', 'patient_test_id');
    }
    public function normalRanges()
    {
        return $this->hasMany(NormalRange::class);
    }


}
