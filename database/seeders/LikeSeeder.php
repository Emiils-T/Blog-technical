<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Post::all()->each(function ($post) {
            $numLikes = rand(0, 5);
            $users = User::inRandomOrder()->take($numLikes)->get();

            foreach ($users as $user) {
                Like::create([
                    'user_id' => $user->id,
                    'target_id' => $post->id,
                    'target_type' => Post::class,
                ]);
            }
        });

        Comment::all()->each(function ($comment) {
            $numLikes = rand(0, 3);
            $users = User::inRandomOrder()->take($numLikes)->get();

            foreach ($users as $user) {
                Like::create([
                    'user_id' => $user->id,
                    'target_id' => $comment->id,
                    'target_type' => Comment::class,
                ]);
            }
        });
    }
}
