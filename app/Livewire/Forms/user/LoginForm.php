<?php

namespace App\Livewire\Forms\user;

use Illuminate\Support\Facades\Auth;
use Livewire\Form;

class LoginForm extends Form
{
    public string $email = '';
    public string $password = '';
    public function rules(): array
    {
        return [
            'email' => [ 'required', 'email' ],
            'password' => [ 'required' ],
        ];
    }
    public function login(): void
    {
        $this->validate();
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], true)) {
            session()->regenerate();
            $this->reset();
        } else {
            $this->addError('email', 'Invalid credentials.');
        }
    }
}
