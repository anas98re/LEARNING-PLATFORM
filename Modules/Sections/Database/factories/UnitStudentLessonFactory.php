<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\Lessons\Lesson;
use Modules\Sections\Entities\Units\Unit;
use Modules\Students\Entities\Student;

class UnitStudentLessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\UnitStudentLesson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lesson_id' =>  Lesson::all()->random()->id,
            'unit_id' =>  Unit::all()->random()->id,
            'student_id' =>  Student::all()->random()->id,
            'can_access' =>  $this->faker->randomElement(['0', '1']),
        ];
    }
}
