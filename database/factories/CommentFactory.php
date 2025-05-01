<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\User;
use App\Models\Podcast;


class CommentFactory extends Factory
{
    public $model = Comment::class;
  
    public function definition(): array
    {
        return [
            'body'=>$this->faker->text,
            'user_id'=>User::factory(),
            'podcast_id'=>Podcast::factory(),
            'parent_id'=>null,
        ];
    
}

}
