<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\AutomatedQuiz;


class AutomatedQuizQuestionFactory extends Factory

{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\AutomatedQuizQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' =>  [
                'en' => $this->faker->text(),
                'ar' => "arabic_text",
            ],
            'automated_quiz_id'  => AutomatedQuiz::all()->random()->id,
        ];
    }
}
