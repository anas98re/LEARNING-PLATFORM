<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\Lessons\Lesson;
use Modules\Students\Entities\Student;

class LessonCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\Lessons\LessonComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment' =>  [
                'en' => $this->faker->name(),
                'ar' => "arabic_text",
            ],
            'student_id'  => Student::all()->random()->id,
            'lesson_id'  => Lesson::all()->random()->id,
        ];
    }
}
