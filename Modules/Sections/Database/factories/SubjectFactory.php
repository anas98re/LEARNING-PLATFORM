<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\SubSection;

class SubjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\Subjects\Subject::class;

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
            'points'  => $this->faker->numberBetween(0, 600),
            'description' =>  [
                'en' => $this->faker->text(),
                'ar' => "arabic_text",
            ],
            'introductory_video' => $this->faker->url(),
            'requirements'  => $this->faker->name() . ',' . $this->faker->name() . ',' . $this->faker->name(),
            'sub_section_id'  => SubSection::all()->random()->id,
            'created_at' => date('Y-m-d H:i:s'),
            'price' => $this->faker->numerify(),
        ];
    }
}
