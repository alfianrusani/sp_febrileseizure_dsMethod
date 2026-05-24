<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Disease extends Model
{
    protected $fillable = ['code', 'name', 'description', 'treatment'];

    public function symptoms(): BelongsToMany
    {
        return $this->belongsToMany(Symptom::class, 'knowledge_base');
    }

    public function diagnoses(): HasMany
    {
        return $this->hasMany(Diagnosis::class);
    }
}
