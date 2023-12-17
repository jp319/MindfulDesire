<?php

namespace App\Livewire\User;

use App\Livewire\Forms\user\ProfileForm;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Profile extends Component
{
    public ProfileForm $form;
    public User $user;
    public function mount(User $user): void
    {
        $this->user = $user;
        $this->form->mount($user);
    }
    public function save(): void
    {
        $this->resetErrorBag();
        $this->form->update();
        $this->dispatch('profile-updated');
    }
    public function close(): void
    {
        $this->resetErrorBag();
        $this->form->mount($this->user);
    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.user.profile');
    }
}
