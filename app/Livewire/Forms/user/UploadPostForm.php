<?php

namespace App\Livewire\Forms\user;

use App\Models\Post;
use App\Services\CryptoJsAesEncryptionService;
use App\Services\PostHelperService;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class UploadPostForm extends Form
{
    public string $title = '';
    public string $body = '';
    public bool $published = false;
    public array $categories = [];
    public TemporaryUploadedFile $image;
    public function rules(): array
    {
        return [
            'title' => 'required|min:6',
            'body' => 'required|min:50',
            'image' => 'required|image|max:10240',
            'published' => 'required|boolean',
        ];
    }
    public function upload(): string
    {
        $this->validate();
        $image_path = $this->image->storeAs(
            "posts",
            $this->image->getClientOriginalName(),
            'public'
        );
        $post = Post::create([
            'title' => CryptoJsAesEncryptionService::autoEncrypt($this->title),
            'slug' => CryptoJsAesEncryptionService::autoEncrypt(PostHelperService::generateSlug($this->title)),
            'excerpt' => CryptoJsAesEncryptionService::autoEncrypt(PostHelperService::generateExcerpt($this->body)),
            'body' => CryptoJsAesEncryptionService::autoEncrypt($this->body),
            'image' => CryptoJsAesEncryptionService::autoEncrypt($image_path),
            'published' => $this->published,
            'published_at' => $this->published ? now() : null,
            'user_id' => auth()->user()->id,
        ]);
        if ($post) {
            foreach ($this->categories as $category) {
                if ($category !== 0) {
                    $post->categories()->attach($category);
                }
            }
        }
        $this->reset(['title', 'body', 'published', 'categories']);
        return $post->slug;
    }
}
