<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'short_hand','price','comment'];

    public function testFields()
    {
        return $this->BelongsToMany(TestField::class);
    }

    public function Patients()
    {
        return $this->BelongsToMany(Patient::class);
    }
}
