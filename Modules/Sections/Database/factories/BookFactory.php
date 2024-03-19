<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\WebSiteLibrary;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' =>  [
                'en' => $this->faker->text(),
                'ar' => "arabic_text",
            ],
            'pdf_path' => $this->faker->text(),
            'website_library_id' => WebSiteLibrary::all()->random()->id,
            'author_name' => $this->faker->name()
        ];
    }
}
