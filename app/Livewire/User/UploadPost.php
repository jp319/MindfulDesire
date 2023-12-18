<?php

namespace App\Livewire\User;

use App\Livewire\Forms\user\UploadPostForm;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadPost extends Component
{
    use WithFileUploads;
    public UploadPostForm $form;
    public Collection $categories;
    public function mount(): void
    {
        $this->categories = Category::all();
    }
    public function uploadPost(): void
    {
        $this->resetErrorBag();
        $slug = $this->form->upload();
        if (!empty($slug)) {
            //$this->redirectRoute('blog.show', ['post' => $slug]);
            $this->redirectRoute('profile.posts');
        }
    }
    public function close(): void
    {
        $this->resetErrorBag();
    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.user.upload-post');
    }
}
