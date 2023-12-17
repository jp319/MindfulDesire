<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\CryptoJsAesEncryptionService;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserPostAndCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $user = User::factory()
            ->create([
                'name' => CryptoJsAesEncryptionService::autoEncrypt('Johnfritz P. Antipuesto'),
                'email' => 'jpantipuesto00104@usep.edu.ph',
                'password' => bcrypt('password'),
                'about_me' => CryptoJsAesEncryptionService::autoEncrypt(
                    'I am a web developer and an IT student at the University of Southeastern Philippines.'
                ),
                'city' => CryptoJsAesEncryptionService::autoEncrypt('Tagum City'),
                'country' => CryptoJsAesEncryptionService::autoEncrypt('Philippines'),
                'birthdate' => CryptoJsAesEncryptionService::autoEncrypt('2001-01-04'),
            ]);
        $posts_data = [
            [
                'title' => CryptoJsAesEncryptionService::autoEncrypt('My first post'),
                'excerpt' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText()),
                'body' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText(2000)),
                'slug' => CryptoJsAesEncryptionService::autoEncrypt('my-first-post'),
                'published' => true,
                'published_at' => now(),
                'user_id' => $user->id,
            ],
            [
                'title' => CryptoJsAesEncryptionService::autoEncrypt('My second post'),
                'excerpt' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText()),
                'body' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText(2000)),
                'slug' => CryptoJsAesEncryptionService::autoEncrypt('my-second-post'),
                'published' => true,
                'published_at' => now(),
                'user_id' => $user->id,
            ],
            [
                'title' => CryptoJsAesEncryptionService::autoEncrypt('My third post'),
                'excerpt' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText()),
                'body' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText(2000)),
                'slug' => CryptoJsAesEncryptionService::autoEncrypt('my-third-post'),
                'published' => true,
                'published_at' => now(),
                'user_id' => $user->id,
            ],
            [
                'title' => CryptoJsAesEncryptionService::autoEncrypt('My fourth post'),
                'excerpt' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText()),
                'body' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText(2000)),
                'slug' => CryptoJsAesEncryptionService::autoEncrypt('my-fourth-post'),
                'published' => true,
                'published_at' => now(),
                'user_id' => $user->id,
            ],
            [
                'title' => CryptoJsAesEncryptionService::autoEncrypt('My fifth post'),
                'excerpt' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText()),
                'body' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText(2000)),
                'slug' => CryptoJsAesEncryptionService::autoEncrypt('my-fifth-post'),
                'published' => true,
                'published_at' => now(),
                'user_id' => $user->id,
            ],
            [
                'title' => CryptoJsAesEncryptionService::autoEncrypt('My sixth post'),
                'excerpt' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText()),
                'body' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText(2000)),
                'slug' => CryptoJsAesEncryptionService::autoEncrypt('my-sixth-post'),
                'published' => true,
                'published_at' => now(),
                'user_id' => $user->id,
            ],
            [
                'title' => CryptoJsAesEncryptionService::autoEncrypt('My seventh post'),
                'excerpt' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText()),
                'body' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText(2000)),
                'slug' => CryptoJsAesEncryptionService::autoEncrypt('my-seventh-post'),
                'published' => true,
                'published_at' => now(),
                'user_id' => $user->id,
            ],
            [
                'title' => CryptoJsAesEncryptionService::autoEncrypt('My eighth post'),
                'excerpt' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText()),
                'body' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText(2000)),
                'slug' => CryptoJsAesEncryptionService::autoEncrypt('my-eighth-post'),
                'published' => true,
                'published_at' => now(),
                'user_id' => $user->id,
            ],
            [
                'title' => CryptoJsAesEncryptionService::autoEncrypt('My ninth post'),
                'excerpt' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText()),
                'body' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText(2000)),
                'slug' => CryptoJsAesEncryptionService::autoEncrypt('my-ninth-post'),
                'published' => true,
                'published_at' => now(),
                'user_id' => $user->id,
            ],
            [
                'title' => CryptoJsAesEncryptionService::autoEncrypt('My tenth post'),
                'excerpt' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText()),
                'body' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText(2000)),
                'slug' => CryptoJsAesEncryptionService::autoEncrypt('my-tenth-post'),
                'published' => true,
                'published_at' => now(),
                'user_id' => $user->id,
            ],
            [
                'title' => CryptoJsAesEncryptionService::autoEncrypt('My eleventh post'),
                'excerpt' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText()),
                'body' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText(2000)),
                'slug' => CryptoJsAesEncryptionService::autoEncrypt('my-eleventh-post'),
                'published' => true,
                'published_at' => now(),
                'user_id' => $user->id,
            ],
            [
                'title' => CryptoJsAesEncryptionService::autoEncrypt('My twelfth post'),
                'excerpt' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText()),
                'body' => CryptoJsAesEncryptionService::autoEncrypt($faker->realText(2000)),
                'slug' => CryptoJsAesEncryptionService::autoEncrypt('my-twelfth-post'),
                'published' => true,
                'published_at' => now(),
                'user_id' => $user->id,
            ],
        ];

        $categories_data = [
            [
                'name' => 'Nutrition',
                'slug' => 'nutrition',
                'color' => 'red'
            ],
            [
                'name' => 'Sleep',
                'slug' => 'sleep',
                'color' => 'blue'
            ],
            [
                'name' => 'Mental Health',
                'slug' => 'mental-health',
                'color' => 'green'
            ],
            [
                'name' => 'Fitness',
                'slug' => 'fitness',
                'color' => 'yellow'
            ],
            [
                'name' => 'Sexual Health',
                'slug' => 'sexual-health',
                'color' => 'purple'
            ],
        ];

        foreach ($posts_data as $post_data) {
            Post::factory()->create($post_data);
        }

        foreach ($categories_data as $category_data) {
            Category::factory()->create($category_data);
        }

        foreach (Post::all() as $post) {
            $count = 1;
            for ($i = 0; $i < Category::all()->count(); $i++) {
                if ($count > Category::all()->count()) {
                    break;
                }
                if (rand(0, 1) == 1) {
                    $post->categories()->attach($count);
                }
                $count++;
            }
        }
    }
}
