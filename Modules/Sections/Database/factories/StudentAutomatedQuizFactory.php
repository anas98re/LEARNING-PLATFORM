<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\AutomatedQuiz;
use Modules\Students\Entities\Student;

class StudentAutomatedQuizFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Students\Entities\StudentAutomatedQuiz::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id'  => Student::all()->random()->id,
            'automated_quiz_id'  => AutomatedQuiz::all()->random()->id,
        ];
    }
}
