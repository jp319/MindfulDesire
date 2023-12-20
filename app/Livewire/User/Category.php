<?php

namespace App\Livewire\User;

use App\Livewire\Forms\user\NewCategoryForm;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Category extends Component
{
    public NewCategoryForm $form;
    public bool $show_create_category_modal = false;

    public function create(): void
    {
        $this->resetErrorBag();
        $created = $this->form->create();
        if ($created) {
            $this->redirectRoute('categories');
        }
    }
    public function close(): void
    {
        $this->resetErrorBag();
    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.user.category');
    }
}
