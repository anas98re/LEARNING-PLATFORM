<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\AutomatedQuizQuestion;

class AqqOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\AqqOption::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'answear' =>  [
                'en' => $this->faker->text(),
                'ar' => "arabic_text",
            ],
            'is_true' =>  $this->faker->boolean(false),
            'aqq_id' => AutomatedQuizQuestion::all()->random()->id,
        ];
    }
}
