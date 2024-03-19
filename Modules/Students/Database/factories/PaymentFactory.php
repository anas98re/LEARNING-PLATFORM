<?php

namespace Modules\Students\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Students\Entities\Student;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Students\Entities\Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $student = Student::all()->random();
        return [
            'student_id' => $student->id,
            'balance' => $this->faker->numerify(),
            'payment_image' => $this->faker->text(),
            'is_aproved' =>  $this->faker->boolean(false),
            'balance_after' =>  $this->faker->numerify(0),
            'balance_before' =>  $student->balance,

        ];
    }
}
