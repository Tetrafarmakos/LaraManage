<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComplexProject extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'budget', 'timeline'];

    protected function casts()
    {
        return [
            'timeline' => 'date'
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
