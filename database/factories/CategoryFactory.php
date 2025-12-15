<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'أخبار' => 'news',
            'بيانات' => 'statements',
            'مذكرات' => 'memos',
            'أنشطة' => 'activities',
            'بلاغات' => 'announcements',
        ];

        $name = $this->faker->unique()->randomElement(array_keys($categories));

        return [
            'name' => $name,
            'slug' => $categories[$name],
            'color' => $this->faker->hexColor,
        ];
    }
}
