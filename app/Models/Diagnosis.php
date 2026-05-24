<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Diagnosis extends Model
{
    protected $fillable = [
        'patient_name', 'gender', 'phone', 'birth_date',
        'age_months', 'address', 'diagnosis_date',
        'disease_id', 'belief_value', 'selected_symptoms',
    ];

    protected $casts = [
        'birth_date'       => 'date',
        'diagnosis_date'   => 'date',
        'belief_value'     => 'float',
        'selected_symptoms'=> 'array',
    ];

    public function disease(): BelongsTo
    {
        return $this->belongsTo(Disease::class);
    }

    public function getBeliefPercentAttribute(): string
    {
        return round($this->belief_value * 100, 2) . '%';
    }
}
