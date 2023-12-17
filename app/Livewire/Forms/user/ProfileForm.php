<?php

namespace App\Livewire\Forms\user;

use App\Models\User;
use App\Services\CryptoJsAesEncryptionService;
use Livewire\Form;

class ProfileForm extends Form
{
    public User $user;
    public string $name = '';
    public string $about_me = '';
    public string $city = '';
    public string $country = '';
    public string $birthdate = '';
    public function mount(User $user): void
    {
        $this->user = $user;
        $this->name = $this->user->name;
        $this->about_me = $this->user->about_me;
        $this->city = $this->user->city;
        $this->country = $this->user->country;
        $this->birthdate = $this->user->birthdate;
    }
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'about_me' => [ 'required', 'string' ],
            'city' => [ 'required', 'string', 'max:255' ],
            'country' => [ 'required', 'string', 'max:255' ],
            'birthdate' => [ 'required', 'date' ],
        ];
    }
    public function update(): void
    {
        $this->validate();
        $this->user->update([
            'name' => CryptoJsAesEncryptionService::autoEncrypt($this->name),
            'about_me' => CryptoJsAesEncryptionService::autoEncrypt($this->about_me),
            'city' => CryptoJsAesEncryptionService::autoEncrypt($this->city),
            'country' => CryptoJsAesEncryptionService::autoEncrypt($this->country),
            'birthdate' => CryptoJsAesEncryptionService::autoEncrypt($this->birthdate),
        ]);
        $this->user->save();
    }
}
