<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::all()->each(function ($post) {
            $numComments = rand(0, 5);
            Comment::factory($numComments)->create([
                'post_id' => $post->id,
                'user_id' => User::inRandomOrder()->first()->id,
            ]);
        });
    }
}
