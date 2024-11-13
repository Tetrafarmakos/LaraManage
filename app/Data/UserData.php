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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(request()->route('user')), 'max:255'],
            'password' => ['required', 'string', 'min_digits:8', 'max:255'],
        ];
    }

    public function excludeProperties(): array
    {
        return [
            'password' => true,
        ];
    }
}
