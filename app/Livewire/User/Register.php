<?php

namespace App\Livewire\User;

use App\Livewire\Forms\user\RegisterForm;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public RegisterForm $form;
    public function register(): void
    {
        $this->resetErrorBag();
        $this->form->register();
        if (Auth::check()) {
            $this->redirectRoute('blog');
        }
    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.user.register');
    }
}
