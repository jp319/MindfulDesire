<?php

namespace App\Livewire\Forms\user;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CommentForm extends Form
{
    public int $post_id;
    public int $user_id;
    public string $body = '';
    public function mount(int $post_id, int $user_id): void
    {
        $this->post_id = $post_id;
        $this->user_id = $user_id;
    }
    public function rules(): array
    {
        return [
            'body' => 'required|min:4|max:255'
        ];
    }
    public function comment(): void
    {
        $this->validate();
        if (auth()->check()) {
            if (auth()->user()->id === $this->user_id) {
                auth()->user()->comments()->create([
                    'post_id' => $this->post_id,
                    'body' => $this->body
                ]);
                $this->reset(['body']);
            }
        }
    }

    public function update(string $body): void
    {
        $this->body = $body;
        $this->validate();
        if (auth()->check()) {
            if (auth()->user()->id === $this->user_id) {
                auth()->user()->comments()->update([
                    'post_id' => $this->post_id,
                    'body' => $this->body
                ]);
                $this->reset(['body']);
            }
        }
    }
}
