<?php

namespace App\Models;

use App\Repositories\CompanyRepository;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, HasUlids;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name'
    ];

    public function repository(): CompanyRepository
    {
        return new CompanyRepository($this);
    }
}
