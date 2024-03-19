<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Database\Seeders\AutomatedQuizQuestionTableSeeder;
use Modules\Sections\Entities\AqqOption;
use Modules\Sections\Entities\AutomatedQuizQuestion;
use Modules\Students\Entities\Student;
use Modules\Students\Entities\StudentAutomatedQuiz;

class StudentAutomatedQuizQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\StudentAutomatedQuizQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'aqq_id' =>  AutomatedQuizQuestion::all()->random()->id,
            'student_id'  => Student::all()->random()->id,
            'point'  => rand(0, 1),
            'aqq_option_id'  => AqqOption::all()->random()->id,
        ];
    }
}
