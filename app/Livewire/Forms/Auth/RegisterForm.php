<?php

namespace App\Livewire\Forms\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Form;

class RegisterForm extends Form
{
    public string $name = '';

    public string $mobile = '';

    public string $user_role = '1';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Attempt to registeration the user.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function registeration(): void
    {
        event(new Registered(($user = User::create(
            $this->only(['name', 'mobile', 'password'])
        ))));

        if ($this->user_role == '2') {
            $role = 'owner';
        } else {
            $role = 'driver';
        }

        $user->assignRole($role);

        Auth::login($user);
    }
}
