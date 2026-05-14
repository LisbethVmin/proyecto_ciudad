<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'correo_electronico' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $user = \App\Models\User::where('correo_electronico', $this->input('correo_electronico'))->first();

        if (!$user) {
           throw ValidationException::withMessages([
            'correo_electronico' => __('auth.failed'),
            ]);
        }

        if (!password_verify($this->input('password'), $user->contrasena)) {
            throw ValidationException::withMessages([
                'correo_electronico' => 'Contraseña incorrecta',
            ]);
        }

        Auth::login($user, $this->boolean('remember'));

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'correo_electronico' => "Demasiados intentos. Intenta en $seconds segundos.",
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(
            Str::lower($this->input('correo_electronico')) . '|' . $this->ip()
        );
    }
}
