<?php

namespace App\Livewire\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class MyPosts extends Component
{
    use WithPagination;
    public array $post_ids;
    public User $user;
    public int $post_per_page = 3;
    public string $post_to_delete = '';
    public bool $confirming_delete_post = false;
    public string $post_to_publish = '';
    public bool $confirming_publish_post = false;
    public string $post_to_unpublish = '';
    public bool $confirming_unpublish_post = false;
    /**
     * Retrieve the post-ids from the database and store it in the $post_ids property.
     *
     * @param Collection $posts
     * @param User $user
     */
    public function mount(Collection $posts, User $user): void
    {
        $this->post_ids = $posts->pluck('id')->toArray();
        $this->user = $user;
    }
    /**
     * Load more posts. This method is called when the `load-more-posts` event is dispatched.
     *
     * @return void
     */
    #[On('load-more-posts')]
    public function loadMore(): void
    {
        $this->post_per_page += 6;
    }
    /**
     * Prepare to publish a post. This method is called when the button to publish a post is clicked.
     *
     * @param string $post_id_to_publish
     * @return void
     */
    public function publishPost(string $post_id_to_publish): void
    {
        $this->post_to_publish = $post_id_to_publish;
        $this->confirming_publish_post = true;
    }
    /**
     * Cancel the publishing of a post. This method is called when the button to cancel the publishing of a post is clicked.
     *
     * @return void
     */
    public function cancelPublish(): void
    {
        $this->post_to_publish = '';
        $this->confirming_publish_post = false;
    }
    /**
     * Publish a post. This method is called when the button to confirm the publishing of a post is clicked.
     *
     * @return void
     */
    public function confirmPublish(): void
    {
        $this->resetErrorBag();
        $post = Post::find($this->post_to_publish);
        if ($post && $post->user_id === $this->user->id) {
            if ($post->published && $post->published_at !== null) {
                $this->addError(
                    'publish',
                    'The post could not be published. It is already published.'
                );
                $this->cancelPublish();
                return;
            } else {
                $post->published = true;
                $post->published_at = now();
                $post->save();
            }
        } else {
            $this->addError(
                'publish',
                'The post could not be published. It either does not exist or you are not the owner.'
            );
        }
        $this->post_to_publish = '';
        $this->confirming_publish_post = false;
    }
    /**
     * Prepare to unpublish a post. This method is called when the button to unpublish a post is clicked.
     *
     * @param string $post_id_to_unpublish
     * @return void
     */
    public function unpublishPost(string $post_id_to_unpublish): void
    {
        $this->post_to_unpublish = $post_id_to_unpublish;
        $this->confirming_unpublish_post = true;
    }
    /**
     * Cancel the unpublishing of a post. This method is called when the button to cancel the unpublishing of a post is clicked.
     *
     * @return void
     */
    public function cancelUnpublish(): void
    {
        $this->post_to_unpublish = '';
        $this->confirming_unpublish_post = false;
    }
    /**
     * Unpublish a post. This method is called when the button to confirm the unpublishing of a post is clicked.
     *
     * @return void
     */
    public function confirmUnpublish(): void
    {
        $this->resetErrorBag();
        $post = Post::find($this->post_to_unpublish);
        if ($post && $post->user_id === $this->user->id) {
            if (!$post->published && $post->published_at === null) {
                $this->addError(
                    'unpublish',
                    'The post could not be unpublished. It is already unpublished.'
                );
                $this->cancelUnpublish();
                return;
            } else {
                $post->published = false;
                $post->published_at = null;
                $post->save();
            }
        } else {
            $this->addError(
                'unpublish',
                'The post could not be unpublished. It either does not exist or you are not the owner.'
            );
        }
        $this->post_to_unpublish = '';
        $this->confirming_unpublish_post = false;
    }
    /**
     * Prepare to delete a post. This method is called when the button to delete a post is clicked.
     *
     * @param string $post_id_to_delete
     * @return void
     */
    public function deletePost(string $post_id_to_delete): void
    {
        $this->post_to_delete = $post_id_to_delete;
        $this->confirming_delete_post = true;
    }
    /**
     * Cancel the deletion of a post. This method is called when the button to cancel the deletion of a post is clicked.
     *
     * @return void
     */
    public function cancelDelete(): void
    {
        $this->post_to_delete = '';
        $this->confirming_delete_post = false;
    }
    /**
     * Delete a post. This method is called when the button to confirm the deletion of a post is clicked.
     *
     * @return void
     */
    public function confirmDelete(): void
    {
        $this->resetErrorBag();
        $post = Post::find($this->post_to_delete);
        if ($post && $post->user_id === $this->user->id) {
            Post::destroy($this->post_to_delete);
        } else {
            $this->addError(
                'delete',
                'The post could not be deleted. It either does not exist or you are not the owner.'
            );
        }
        $this->post_to_delete = '';
        $this->confirming_delete_post = false;
    }
    /**
     * Close the modal. This method is called when the button to close the modal is clicked.
     *
     * @return void
     */
    public function closeErrorModal(): void
    {
        $this->resetErrorBag();
        $this->cancelDelete();
    }
    /**
     * Render the component.
     *
     * @return View|Factory|Application|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $posts = Post::whereIn('id', $this->post_ids)
            ->where('user_id', $this->user->id)
            //->where('published', true)
            ->latest()
            ->paginate($this->post_per_page);
        $remaining_posts = count($this->post_ids);

        return view('livewire.post.my-posts', [
            'posts' => $posts,
            'remaining_posts' => $remaining_posts,
        ]);
    }
}
