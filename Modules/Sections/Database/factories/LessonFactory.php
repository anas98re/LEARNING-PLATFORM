<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\Subjects\Subject;
use Modules\Sections\Entities\Units\Unit;

class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\Lessons\Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' =>  [
                'en' => $this->faker->name(),
                'ar' => "arabic_text",
            ], 'description' =>  [
                'en' => $this->faker->text(),
                'ar' => "arabic_text",
            ],
            'isFree' => $this->faker->numberBetween(0, 1),
            'cover'  => $this->faker->url(),
            'points'  => $this->faker->numberBetween(1, 100),
            'duration'  => $this->faker->numberBetween(1, 100),
            'video' => $this->faker->imageUrl(),
            'unit_id'  => Unit::all()->random()->id,
            'video'  => $this->faker->url(),
            'what_we_will_learn' => $this->faker->name() . ',' . $this->faker->name() . ',' . $this->faker->name(),
            'subject_id'  => Subject::all()->random()->id,
            'created_at' => date('Y-m-d H:i:s'),
            'video' => $this->faker->text(),
        ];
    }
}
