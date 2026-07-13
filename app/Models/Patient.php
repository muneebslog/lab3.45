<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'age_unit', 'phone', 'gender', 'doctor', 'receipt_no'];

    public function tests()
    {
        return $this->BelongsToMany(Test::class)
            ->withPivot('isResultAdded', 'isPrinted', 'printed_at', 'id');
    }

    /**
     * Match phone stored in various formats against normalized digits (and optional raw input).
     */
    public function scopeGuestPhoneLookup($query, string $digits, ?string $rawPhone = null)
    {
        return $query->where(function ($q) use ($digits, $rawPhone) {
            if (filled($rawPhone)) {
                $q->where('phone', $rawPhone);
            }
            $q->orWhere('phone', $digits)
                ->orWhereRaw(
                    "trim(replace(replace(replace(replace(replace(coalesce(phone, ''), ' ', ''), '-', ''), '(', ''), ')', ''), '+', '')) = ?",
                    [$digits]
                );
        });
    }
}
