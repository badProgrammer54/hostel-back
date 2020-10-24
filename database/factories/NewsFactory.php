<?php

namespace Database\Factories;

use App\Models\News;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        try {
            $title = $this->faker->sentence(random_int(3, 8), true);
        } catch (Exception $e) {
            $title = 'error';
        }

        try {
            $txt = $this->faker->realText(random_int(1000, 4000));
        } catch (Exception $e) {
            $txt = 'error';
        }

        try {
            $isPublished = random_int(1, 5) > 1;
        } catch (Exception $e) {
            $isPublished = false;
        }

        try {
            $categoryId = random_int(1, 11);
        } catch (Exception $e) {
            $categoryId = 1;
        }

        try {
            $userId = random_int(1, 4) !== 1 ? 1 : 2;
        } catch (Exception $e) {
            $userId = 1;
        }

        try {
            $excerpt = $this->faker->text(random_int(40, 100));
        } catch (Exception $e) {
            $excerpt = 'error';
        }

        $dataAt = $this->faker->dateTimeBetween('-3 months');

        $data = [
            'category_id' => $categoryId,
            'user_id' => $userId,
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $excerpt,
            'content_raw' => $txt,
            'content_html' => $txt,
            'is_published' => $isPublished,
            'published_at' => $isPublished ? $this->faker->dateTimeBetween('-2 months') : null,
            'created_at' => $dataAt,
            'updated_at' => $dataAt
        ];

        return $data;
    }
}