<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'excerpt' => $this->faker->paragraph(),
            'body' => $this->faker->paragraphs(5, true),
            'slug' => $this->faker->slug(),
            'published' => $this->faker->boolean(),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function title(string $title): static
    {
        return $this->state(fn (array $attributes) => [
            'title' => $title,
        ]);
    }

    public function excerpt(string $excerpt): static
    {
        return $this->state(fn (array $attributes) => [
            'excerpt' => $excerpt,
        ]);
    }

    public function body(string $body): static
    {
        return $this->state(fn (array $attributes) => [
            'body' => $body,
        ]);
    }

    public function slug(string $slug): static
    {
        return $this->state(fn (array $attributes) => [
            'slug' => $slug,
        ]);
    }
    public function published(bool $published): static
    {
        return $this->state(fn (array $attributes) => [
            'published' => $published,
        ]);
    }

    public function published_at(string $published_at): static
    {
        return $this->state(fn (array $attributes) => [
            'published_at' => $published_at,
        ]);
    }
}
