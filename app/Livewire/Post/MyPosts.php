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
    public $post_ids;
    public User $user;
    public $post_per_page = 3;

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
     * Render the component.
     *
     * @return View|Factory|Application|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $posts = Post::whereIn('id', $this->post_ids)
            ->where('user_id', $this->user->id)
            //->where('published', true)
            ->oldest()
            ->paginate($this->post_per_page);
        $remaining_posts = count($this->post_ids);

        return view('livewire.post.my-posts', [
            'posts' => $posts,
            'remaining_posts' => $remaining_posts,
        ]);
    }
}
