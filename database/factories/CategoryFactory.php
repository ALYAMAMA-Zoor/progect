<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;


class CategoryFactory extends Factory
{
    public $model = Category::class;

    public function definition(): array
    {
        return [
            'name'=>$this->faker->text,
        ];

}
}