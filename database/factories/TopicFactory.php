<?php

namespace Database\Factories;

use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Topic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(60),
            'body' => "<p>".implode('</p><p>', $this->faker->paragraphs(5))."</p>",
            'link' => $this->faker->url,
            'author_id' => 1,
            'last_comment_at' => Carbon::now()
        ];
    }
}
