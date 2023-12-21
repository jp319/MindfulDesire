<?php

namespace App\Livewire\User;

use App\Livewire\Forms\user\CommentForm;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Component;

class Comment extends Component
{
    public Post $post;
    public CommentForm $form;
    public Collection $comments;
    public int $comment_count;
    public int $comment_to_delete;
    public bool $show_delete_modal = false;
    public int $comment_to_edit;
    public bool $show_edit_modal = false;
    public string $edited_body = '';
    public function mount(Post $post): void
    {
        $this->post = $post;
        $this->comments = $post->comments;
        $this->comment_count = $post->comments()->count();
        if (auth()->check()) {
            $this->form->mount($post->id, auth()->user()->id);
        }
    }
    public function comment(): void
    {
        $this->resetErrorBag();
        $this->form->comment();
        $this->refresh();
    }

    public function confirmEdit(int $comment_id): void
    {
        $this->comment_to_edit = $comment_id;
        $comment = \App\Models\Comment::where('id', $this->comment_to_edit)
                    ->where('user_id', auth()->user()->id)
                    ->where('post_id', $this->post->id)
                    ->first();
        if ($comment) {
            $this->edited_body = $comment->body;
        } else {
            $this->addError('comment', 'Comment not found.');
        }
        $this->show_edit_modal = true;
    }
    public function edit(): void
    {
        $this->resetErrorBag();
        $this->form->update($this->edited_body);
        $this->show_edit_modal = false;
        $this->refresh();
    }
    public function confirmDelete(int $comment_id): void
    {
        $this->comment_to_delete = $comment_id;
        $this->show_delete_modal = true;
    }
    public function delete(): void
    {
        $comment = $this->post->comments()
                    ->where('id', $this->comment_to_delete)
                    ->where('user_id', auth()->user()->id)
                    ->first();
        if ($comment) {
            $comment->delete();
            $this->refresh();
        } else {
            $this->addError('comment', 'Comment not found.');
        }
        $this->show_delete_modal = false;
    }
    public function refresh(): void
    {
        $this->comments = $this->post->comments;
        $this->comment_count = $this->post->comments()->count();
    }
    public function close(): void
    {
        $this->resetErrorBag();
    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.user.comment');
    }
}
