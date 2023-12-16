<?php

namespace App\Livewire\User;

use App\Livewire\Forms\user\LoginForm;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public LoginForm $form;
    public function login(): void
    {
        $this->resetErrorBag();
        $this->form->login();
        if (Auth::check()) {
            $this->redirectRoute('blog');
        }
    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.user.login');
    }
}
