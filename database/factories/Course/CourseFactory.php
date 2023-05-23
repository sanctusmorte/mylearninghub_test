<?php

namespace Database\Factories\Course;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(30),
        ];
    }
}
