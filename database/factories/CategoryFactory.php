<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'slug'=> $this->faker->unique()->slug,
            'description' => $this->faker->sentences(3,true),
            'is_parent' => $this->faker->randomElement([true,false]),
            'parent_id' => $this->faker->randomElement(Category::pluck('id')->toArray()),
        ];
    }
}
