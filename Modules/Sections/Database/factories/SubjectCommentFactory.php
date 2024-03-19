<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\Subjects\Subject;
use Modules\Students\Entities\Student;

class SubjectCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\Subjects\SubjectComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment' =>  [
                'en' => $this->faker->text(),
                'ar' => "arabic_text",
            ],
            'student_id'  => Student::all()->random()->id,
            'subject_id'  => Subject::all()->random()->id,
        ];
    }
}
