<?php

namespace App\Livewire\Forms\user;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Form;

class RegisterForm extends Form
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [ 'required', 'email', 'max:255', 'unique:users' ],
            'password' => [ 'required', 'min:8', 'confirmed' ],
            'password_confirmation' => [ 'required', 'min:8' ],
        ];
    }
    public function register(): void
    {
        $this->validate();
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ])->save();
        if ($user) {
            Auth::attempt(['email' => $this->email, 'password' => $this->password], true);
        }
    }
}
