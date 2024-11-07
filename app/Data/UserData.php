<?php

namespace App\Data;

use App\Models\User;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Illuminate\Validation\Rule;

class UserData extends Data
{
    public function __construct(
        public ?string     $id,
        public string      $name,
        public string      $email,
        public string|Lazy $password,
    )
    {
    }

    public static function fromModel(User $user): self
    {
        return new self(
            $user->id,
            $user->name,
            $user->email,
            Lazy::create(fn() => $user->password)
        );
    }

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(request()->route('user'))],
            'password' => ['required', 'string', 'min_digits:8'],
        ];
    }

    public function excludeProperties(): array
    {
        return [
            'password' => true,
        ];
    }
}
