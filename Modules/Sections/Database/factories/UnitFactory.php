<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\Subjects\Subject;

class UnitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\Units\Unit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' =>  [
                'en' => $this->faker->name(),
                'ar' => "arabic_text",
            ],
            'cover'  => $this->faker->imageUrl(),
            'video'=>"https://www.youtube.com/watch?v=LxPeNvOlH3s" ,
            'points'  => $this->faker->numberBetween(0, 600),
            'description' =>  [
                'en' => $this->faker->text(),
                'ar' => "arabic_text",
            ],
            'start_date' => $this->faker->date(),
            'end_date' =>  $this->faker->date(),
            'isFree' =>  rand(0, 1),
            'requirements' =>  [
                'en' => $this->faker->name(),
                'ar' => "arabic_text",
            ],
            'order' => $this->faker->numberBetween(0, 600),
            'subject_id'  => Subject::all()->random()->id,
        ];
    }
}
