<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\Lessons\LessonQuestion;
use Modules\Students\Entities\Student;

class StudentLessonQuestionFactory extends Factory
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
            'lesson_questions_id' =>  LessonQuestion::all()->random()->id,
            'student_id'  => Student::all()->random()->id,
            'point'  => rand(0, 1),
            'student_has_show'  => rand(0, 1),

        ];
    }
}
