<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WebSiteLibraryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\WebSiteLibrary::class;

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
            'image' => $this->faker->imageUrl(),
            'is_free' => $this->faker->randomElement(['0', '1']),
        ];
    }
}
