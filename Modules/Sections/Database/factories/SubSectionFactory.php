<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\Section;

class SubSectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\SubSection::class;

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
            'image' =>  $this->faker->imageUrl(),
            'section_id' =>  Section::all()->random()->id,
        ];
    }
}
