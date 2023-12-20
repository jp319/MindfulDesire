<?php

namespace App\Livewire\Forms\user;

use App\Models\Post;
use App\Services\CryptoJsAesEncryptionService;
use App\Services\PostHelperService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class MyPostForm extends Form
{
    public Post $post;
    public string $title = '';
    public string $body = '';
    public bool $published = false;
    public array $categories = [];
    public bool $change_image = false;
    public TemporaryUploadedFile $image;

    public function mount(Post $post): void
    {
        $this->post = $post;
        $this->title = $this->post->title;
        $this->body = $this->post->body;
        $this->published = $this->post->published;
        $this->categories = $this->post->categories->pluck('id')->toArray();
    }
    public function rules(): array
    {
        return [
            'title' => 'required|min:6',
            'body' => 'required|min:50',
            'image' => [
                Rule::unless(
                    !$this->change_image,
                    ['required', 'image', 'max:10240'],
                )
            ],
//            'image' => 'required_unless:change_image,false|image|max:10240',
            'published' => 'required|boolean',
        ];
    }

    public function update(): bool
    {
        $this->validate();
        $post_is_updated = false;

        if ($this->post->author->id === auth()->user()->id) {

            if ($this->change_image) {
                Storage::disk('public')->delete($this->post->image);
                $image_path = $this->image->storeAs(
                    "posts",
                    \Str::random().'-'.'('.time().')'.'['.auth()->user()->id.']' . $this->image->getClientOriginalName(),
                    'public'
                );
                $this->post->update([
                    'image' => CryptoJsAesEncryptionService::autoEncrypt($image_path),
                ]);
                $post_is_updated = true;
            }

            if ($this->title !== $this->post->title) {
                $this->post->update([
                    'title' => CryptoJsAesEncryptionService::autoEncrypt($this->title),
                    'slug' => CryptoJsAesEncryptionService::autoEncrypt(PostHelperService::generateSlug($this->title)),
                ]);
                $post_is_updated = true;
            }

            if ($this->body !== $this->post->body) {
                $this->post->update([
                    'excerpt' => CryptoJsAesEncryptionService::autoEncrypt(PostHelperService::generateExcerpt($this->body)),
                    'body' => CryptoJsAesEncryptionService::autoEncrypt($this->body),
                ]);
                $post_is_updated = true;
            }

            if ($this->published !== $this->post->published) {
                $this->post->update([
                    'published' => $this->published,
                    'published_at' => $this->published ? now() : null,
                ]);
                $post_is_updated = true;
            }

            if ($this->categories !== $this->post->categories->pluck('id')->toArray()) {
                $this->post->categories()->sync($this->categories);
                $post_is_updated = true;
            }

            if (!$post_is_updated) {
                $this->addError('title', 'Nothing to update');
            }
        } else {
            $this->addError('title', 'You are not the author of this post');
        }

        return $post_is_updated;
    }
}
