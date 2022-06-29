<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2,8)),
            'slug' => $this->faker->slug(),
            'user_id' =>  mt_rand(1,3),
            'description' => collect($this->faker->paragraphs(mt_rand(5,10)))
                            ->map(fn($p) => "<p>$p</p>" )
                            ->implode(''),
            'type'        => 'Freelance',
            'category_id' => mt_rand(1,3),
            'status_job'  => 'ongoing',
            'expected_salary' => '3000000'
        ];
    }
}
