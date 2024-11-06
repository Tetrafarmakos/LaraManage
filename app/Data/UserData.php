<?php

namespace App\Data;

use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public string  $name,
        public string  $email,
        public ?string $password,
    )
    {
    }

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min_digits:8'],
        ];
    }
}
