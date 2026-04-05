<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\password;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class NewLabuserCommand extends Command
{
    protected $signature = 'new:labuser
                            {--name= : Display name}
                            {--email= : Email address (must be unique)}
                            {--password= : Password (avoid on shared systems; requires --password-confirmation when non-interactive)}
                            {--password-confirmation= : Must match --password}
                            {--role= : admin or staff}
                            {--update : Update an existing user with the same email}';

    protected $description = 'Create (or update) a lab user: name, email, password, role';

    public function handle(): int
    {
        $name = $this->stringOption('name') ?? $this->promptName();
        $email = $this->stringOption('email') ?? $this->promptEmail();

        if ($name === null || $email === null) {
            return self::FAILURE;
        }

        $existing = User::query()->where('email', $email)->first();
        $isUpdate = (bool) $existing;

        if ($isUpdate && ! $this->option('update')) {
            $this->error("A user with email [{$email}] already exists. Pass --update to change name, role, and optionally password.");

            return self::FAILURE;
        }

        $passwordPlain = $this->resolvePassword($existing);
        if ($passwordPlain === false) {
            return self::FAILURE;
        }

        $role = $this->resolveRole();
        if ($role === null) {
            return self::FAILURE;
        }

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => ['nullable', Rule::in(['admin', 'staff'])],
        ];
        $data = [
            'name' => $name,
            'email' => $email,
            'role' => $role,
        ];
        if ($passwordPlain !== null) {
            $rules['password'] = ['required', 'string', 'min:8'];
            $data['password'] = $passwordPlain;
        } elseif (! $isUpdate) {
            $this->error('Password is required for new users.');

            return self::FAILURE;
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                $this->error($message);
            }

            return self::FAILURE;
        }

        $attributes = [
            'name' => $name,
            'email_verified_at' => $existing?->email_verified_at ?? now(),
            'role' => $role,
        ];
        if ($passwordPlain !== null) {
            $attributes['password'] = $passwordPlain;
        }

        $user = User::query()->updateOrCreate(
            ['email' => $email],
            $attributes
        );

        $this->components->info(
            $isUpdate
                ? "Updated lab user [{$user->email}] (role: {$user->role})."
                : "Created lab user [{$user->email}] (role: {$user->role})."
        );

        return self::SUCCESS;
    }

    private function stringOption(string $key): ?string
    {
        $value = $this->option($key);

        return is_string($value) && $value !== '' ? $value : null;
    }

    private function promptName(): ?string
    {
        if ($this->option('no-interaction')) {
            $this->error('Option --name is required when running non-interactively.');

            return null;
        }

        return text(
            label: 'Name',
            required: true,
            validate: fn (string $value) => match (true) {
                strlen(trim($value)) === 0 => 'Name is required.',
                strlen($value) > 255 => 'Name may not be longer than 255 characters.',
                default => null,
            }
        );
    }

    private function promptEmail(): ?string
    {
        if ($this->option('no-interaction')) {
            $this->error('Option --email is required when running non-interactively.');

            return null;
        }

        return text(
            label: 'Email',
            required: true,
            validate: function (string $value) {
                $v = Validator::make(['email' => $value], ['email' => 'required|email|max:255']);

                return $v->fails() ? $v->errors()->first('email') : null;
            }
        );
    }

    /**
     * @return string|null Plain password, or null to keep existing (updates only). False on failure.
     */
    private function resolvePassword(?User $existing): string|null|false
    {
        $optPass = $this->stringOption('password');
        $optConfirm = $this->stringOption('password-confirmation');
        $isUpdate = (bool) $existing;

        if ($this->option('no-interaction')) {
            if ($optPass === null) {
                if ($isUpdate && $this->option('update')) {
                    return null;
                }
                $this->error('Option --password is required when creating a user non-interactively.');

                return false;
            }
            if ($optConfirm === null) {
                $this->error('Option --password-confirmation is required when setting a password non-interactively.');

                return false;
            }
            if ($optPass !== $optConfirm) {
                $this->error('Password and password confirmation do not match.');

                return false;
            }

            return $optPass;
        }

        if ($optPass !== null) {
            if ($optConfirm === null || $optPass !== $optConfirm) {
                $this->error('When using --password, you must also pass --password-confirmation with the same value.');

                return false;
            }

            return $optPass;
        }

        if ($isUpdate && $this->option('update')) {
            if (! confirm('Change password?', default: false)) {
                return null;
            }
        }

        while (true) {
            $first = password(
                label: 'Password',
                required: true,
                validate: fn (string $value) => strlen($value) < 8
                    ? 'Password must be at least 8 characters.'
                    : null
            );
            $second = password(
                label: 'Confirm password',
                required: true
            );
            if ($first === $second) {
                return $first;
            }
            $this->warn('Passwords do not match. Try again.');
        }
    }

    private function resolveRole(): ?string
    {
        $opt = $this->stringOption('role');
        if ($opt !== null) {
            $normalized = strtolower($opt);
            if (! in_array($normalized, ['admin', 'staff'], true)) {
                $this->error('Role must be "admin" or "staff".');

                return null;
            }

            return $normalized;
        }

        if ($this->option('no-interaction')) {
            $this->error('Option --role is required when running non-interactively (admin or staff).');

            return null;
        }

        $choice = select(
            label: 'Role',
            options: [
                'admin' => 'Administrator (full access, Filament)',
                'staff' => 'Staff (register cases & view reports only)',
            ],
            default: 'admin'
        );

        return $choice;
    }
}
