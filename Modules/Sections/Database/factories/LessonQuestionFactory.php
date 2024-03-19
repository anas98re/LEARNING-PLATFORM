<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\Lessons\Lesson;

class LessonQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\Lessons\LessonQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' =>  [
                'en' => $this->faker->text(),
                'ar' => "arabic_text",
            ],
            'time_question' => $this->faker->time(),
            'lesson_id'  => Lesson::all()->random()->id,
            'options'  => [
                [
                    'id' => 1,
                    'answear' =>  [
                        'en' => $this->faker->text(),
                        'ar' => "arabic_text",
                    ],
                    'is_true' => $this->faker->boolean(true),
                ],
                [
                    'id' => 2,
                    'answear' =>  [
                        'en' => $this->faker->text(),
                        'ar' => "arabic_text",
                    ],
                    'is_true' => $this->faker->boolean(false),
                ],
                [
                    'id' => 3,
                    'answear' =>  [
                        'en' => $this->faker->text(),
                        'ar' => "arabic_text",
                    ],
                    'is_true' => $this->faker->boolean(false),
                ],
                [
                    'id' => 4,
                    'answear' =>  [
                        'en' => $this->faker->text(),
                        'ar' => "arabic_text",
                    ],
                    'is_true' => $this->faker->boolean(false),
                ],
            ]
        ];
    }
}
