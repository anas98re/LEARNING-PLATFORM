<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\Subjects\Subject;
use Modules\Students\Entities\Student;

class StudentSubjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\Subjects\StudentSubject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject_id'  => Subject::all()->random()->id,
            'student_id'  => Student::all()->random()->id,
        ];
    }
}
