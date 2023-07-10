<?php

namespace Database\Factories;

use App\Models\Post;
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
        Post::truncate();
        fake();
        $name = $this->faker->sentence;
        return [
            'title' => $name,
            'slug' => str($name)->slug(),
            'content' => fake()->paragraphs(20, true),
            'description' => $this->faker->paragraphs(3, true),
            'category_id' => $this->faker->randomElement([1,2,3,5,7,13]),
            'posted' => $this->faker->randomElement(['yes','not']),
            'image' => $this->faker->imageUrl(),
            'user_id' => $this->faker->randomElement([1,2]),

        ];
    }
}
