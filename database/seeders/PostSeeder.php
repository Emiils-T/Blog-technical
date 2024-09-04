<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::all()->each(function ($user) {
            Post::factory(rand(1, 5))->create(['user_id' => $user->id])
                ->each(function ($post) {
                    $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
                    $post->categories()->attach($categories);
                });
        });
    }
}
