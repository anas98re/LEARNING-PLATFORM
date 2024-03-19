<?php

namespace Modules\Admin\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sections\Entities\Lessons\Lesson;
use Modules\Sections\Entities\Subjects\Subject;
use Modules\Sections\Entities\Units\Unit;

class FaqsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Admin\Entities\Faqs::class;


    public function definition()
    {
        $randomFieldNumber = $this->faker->numberBetween(1, 3);
        if ($randomFieldNumber == 1) {
            $randomField = 'subject_id';
            $randomFieldId = Subject::all()->random()->id;
        } elseif ($randomFieldNumber == 2) {
            $randomField = 'unit_id';
            $randomFieldId = Unit::all()->random()->id;
        } else {
            $randomField = 'lesson_id';
            $randomFieldId = Lesson::all()->random()->id;
        }
        return [
            'question' => $this->faker->text(),
            'answer' => $this->faker->text(),
            $randomField => $randomFieldId,
        ];
    }
}
