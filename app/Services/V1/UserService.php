<?php

namespace App\Services\V1;

use App\Models\User;
use App\Services\Service;
use Closure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class UserService extends Service
{
    public function validate(array $data): array
    {
        $rules = [
            'current_password' => [fn(): Closure => function (string $attribute, $value, Closure $fail) {
                if (! password_verify($value, auth()->user()->password)) {
                    $fail('A senha digitada e a senha atual não correspondem');
                }
            },],
            'new_password' => [Password::default()->numbers()]
        ];
        $messages = [];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails())
        {
            throw new ValidationException($validator);
        }

        return $validator->validate();
    }

    public function changePassword(User $user, array $data): User
    {
        $validated = $this->validate($data);

        if (! password_verify($validated['current_password'], $user->password)) {
            throw new \Exception('A senha atual não confere a senha do usuário'); // @codeCoverageIgnore
        }

        if (password_verify($validated['new_password'], $user->password)) {
            throw new \Exception('A nova senha é a mesma da antiga'); // @codeCoverageIgnore
        }

        $user->update(['password' => $validated['new_password']]);

        return $user;
    }
}
