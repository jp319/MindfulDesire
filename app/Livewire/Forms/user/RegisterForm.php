<?php

namespace App\Livewire\Forms\user;

use App\Models\User;
use App\Services\CryptoJsAesEncryptionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Form;

class RegisterForm extends Form
{
    public string $name = '';
    public string $email = '';
    public string $about_me = '';
    public string $city = '';
    public string $country = '';
    public string $birthdate = '';
    public string $password = '';
    public string $password_confirmation = '';
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [ 'required', 'email', 'max:255', 'unique:users' ],
            'about_me' => [ 'required', 'string' ],
            'city' => [ 'required', 'string', 'max:255' ],
            'country' => [ 'required', 'string', 'max:255' ],
            'birthdate' => [ 'required', 'date' ],
            'password' => [ 'required', 'min:8', 'confirmed' ],
            'password_confirmation' => [ 'required', 'min:8' ],
        ];
    }
    public function register(): void
    {
        $this->validate();
        $user = User::create([
            'name' => CryptoJsAesEncryptionService::autoEncrypt($this->name),
            'email' => $this->email,
            'about_me' => CryptoJsAesEncryptionService::autoEncrypt($this->about_me),
            'city' => CryptoJsAesEncryptionService::autoEncrypt($this->city),
            'country' => CryptoJsAesEncryptionService::autoEncrypt($this->country),
            'birthdate' => CryptoJsAesEncryptionService::autoEncrypt($this->birthdate),
            'password' => Hash::make($this->password),
        ])->save();
        if ($user) {
            Auth::attempt(['email' => $this->email, 'password' => $this->password], true);
        }
    }
}
