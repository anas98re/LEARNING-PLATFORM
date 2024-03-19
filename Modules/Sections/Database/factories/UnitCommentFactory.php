<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\Units\Unit;
use Modules\Students\Entities\Student;

class UnitCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\Units\UnitComment::class;

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
            'unit_id'  => Unit::all()->random()->id,
        ];
    }
}
