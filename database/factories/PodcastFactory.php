<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\User;
use App\Models\Podcast;

class PodcastFactory extends Factory
{
    public $model = Podcast::class;
    public function definition(): array
    { 
            return [
            'title'=>$this->faker->text, 
            'description'=>$this->faker->paragraph,
            'file_path'=>'fake/path/to/audio.mp3', 
            'cover_image'=>'fake/path/to/image.jpg',
            'user_id'=>User::factory(),
        ];
        
        
    
    }
}