<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\TraditionalQuiz;

class TraditionalQuizQuestionFileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\TraditionalQuizQuestionFile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'file_link' => $this->faker->url(),
            'traditional_quiz_id' => TraditionalQuiz::all()->random()->id,
        ];
    }
}
