<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\Lessons\Lesson;
use Modules\Sections\Entities\Subjects\Subject;
use Modules\Sections\Entities\Units\Unit;

class AutomatedQuizFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\AutomatedQuiz::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' =>  [
                'en' => $this->faker->text(),
                'ar' => "arabic_text",
            ],
            'nameOfQuiz' =>  [
                'en' => $this->faker->name(),
                'ar' => "arabic_text",
            ],
            'isFinal' => $this->faker->boolean(),
            'isAboveLevel' => $this->faker->boolean(),
            'points' => $this->faker->randomElement([10, 20, 30, 40, 50, 60, 70, 80, 90, 100]),
            'duration' => $this->faker->randomElement([10, 20, 30, 40, 50, 60, 70, 80, 90, 100]),
            'lesson_id'  => Lesson::all()->random()->id,
            'unit_id'  => Unit::all()->random()->id,
            'subject_id'  => Subject::all()->random()->id,
        ];
    }
}
