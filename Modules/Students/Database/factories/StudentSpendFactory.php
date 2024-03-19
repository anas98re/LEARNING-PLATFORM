<?php

namespace Modules\Students\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Admin\Entities\Subscription;
use Modules\Students\Entities\Student;

class StudentSpendFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Students\Entities\StudentSpend::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $balance = 2;
        $student = Student::where('balance', '>', $balance)->inRandomOrder()->first();

        return [
            'student_receiver_id' =>  Student::whereNot('id', $student->id)->inRandomOrder()->first()->id,
            'student_id' => $student->id,
            'balance_before' => $student->balance,
            'balance' =>  $balance,
            'balance_after' => $student->balance - $balance,
            'is_aproved' => $this->faker->boolean(false),
        ];
    }
}
