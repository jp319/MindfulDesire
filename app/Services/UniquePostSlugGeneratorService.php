<?php

namespace App\Services;

use App\Models\Post;

class UniquePostSlugGeneratorService
{
    /**
     * Generate a unique slug for the post.
     * @param string $title
     * @return string
     */
    public static function generateSlug(string $title): string
    {
        $slug = \Str::slug($title);
        $slugs = Post::all()->pluck('slug')->toArray();
        $count = 1;

        do {
            foreach ($slugs as $s) {
                if ($s === $slug) {
                    $slug = \Str::slug($title) . '-' . $count++;
                }
            }
        } while (in_array($slug, $slugs));

        return $slug;
    }
}
