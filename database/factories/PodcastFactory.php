<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\User;
use App\Models\Podcast;

class PodcastFactory extends Factory
{
    protected $model = Podcast::class;
   
    public function definition(): array
    {
        return [
            'title'=>$this->faker->sentence, 
            'description'=>null,
            'file_path'=>null, 
            'cover_image'=>null,
          
        ];
    }
}
