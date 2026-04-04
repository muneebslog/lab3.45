<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NormalRange extends Model
{
    use HasFactory;
    protected $table = 'normal_ranges';
    protected $fillable = [
        "test_field_id", 'min_value',"max_value",'gender'
    ];

    // Define the inverse relationship
    public function testField()
    {
        return $this->belongsTo(TestField::class);
    }
}
