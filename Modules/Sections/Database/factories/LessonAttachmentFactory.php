<?php

namespace Modules\Sections\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\Lessons\Lesson;

class LessonAttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Sections\Entities\Lessons\LessonAttachment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' =>  [
                'en' => $this->faker->name(),
                'ar' => "arabic_text",
            ],
            'type' => $this->faker->title(),
            'file'  => $this->faker->url(),
            'lesson_id'  => Lesson::all()->random()->id,

        ];
    }
}
