<?php

namespace App\Models;

use App\Enums\ProjectTypeEnum;
use App\Repositories\ProjectRepository;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    use HasFactory, HasUlids;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'description',
        'company_id',
        'type'
    ];

    public function repository(): ProjectRepository
    {
        return new ProjectRepository($this);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function complexDetails(): HasOne
    {
        return $this->hasOne(ComplexProject::class, 'project_id', 'id');
    }

    public function isComplex(): bool
    {
        return $this->type === ProjectTypeEnum::complex();
    }
}
