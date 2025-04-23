<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\User;
use App\Models\Podcast;


class CommentFactory extends Factory
{
    protected $model = Comment::class;
  
    public function definition(): array
    {
        return [
            'body'=>$this->faker->sentence,
            'user_id'=>null,
            'podcast_id'=>null,
            'parent_id'=>null,
        ];
    }
}
