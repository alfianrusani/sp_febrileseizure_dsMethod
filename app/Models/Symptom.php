<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Symptom extends Model
{
    protected $fillable = ['code', 'name', 'density'];

    protected $casts = ['density' => 'float'];

    public function diseases(): BelongsToMany
    {
        return $this->belongsToMany(Disease::class, 'knowledge_base');
    }
}
