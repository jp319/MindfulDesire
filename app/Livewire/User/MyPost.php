<?php

namespace App\Livewire\User;

use App\Livewire\Forms\user\MyPostForm;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyPost extends Component
{
    use WithFileUploads;
    public MyPostForm $form;
    public Post $post;
    public Collection $categories;
    public array $selected_categories = [];
    public bool $show_edit_modal = false;
    public bool $show_unpublish_modal = false;
    public bool $show_publish_modal = false;
    public bool $show_delete_modal = false;
    public function mount(Post $post): void
    {
        $this->form->mount($post);
        $this->post = $post;
        $this->categories = Category::all();

        foreach ($this->post->categories as $category) {
            $this->selected_categories[] = ''.$category->id;
        }
    }
    public function editForm(): void
    {
        $this->resetErrorBag();
        $post_is_updated = $this->form->update();
        if ($post_is_updated) {
            $this->redirectRoute('blog.show', ['post' => $this->post->slug]);
        }
    }
    public function unpublish(): void
    {
        $this->resetErrorBag();
        $this->form->published = false;
        $post_is_updated = $this->form->update();
        if ($post_is_updated) {
            $this->redirectRoute('blog.show', ['post' => $this->post->slug]);
        }
    }
    public function publish(): void
    {
        $this->resetErrorBag();
        $this->form->published = true;
        $post_is_updated = $this->form->update();
        if ($post_is_updated) {
            $this->redirectRoute('blog.show', ['post' => $this->post->slug]);
        }
    }

    public function delete(): void
    {
        $this->resetErrorBag();
        $post_is_deleted = $this->form->post->delete();
        if ($post_is_deleted) {
            $this->redirectRoute('profile.posts');
        }
    }
    public function close(): void
    {
        $this->resetErrorBag();
    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.user.my-post');
    }
}
