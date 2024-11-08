<?php

namespace App\Models;

use App\Repositories\CompanyRepository;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory, HasUlids;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name'
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function repository(): CompanyRepository
    {
        return new CompanyRepository($this);
    }
}
