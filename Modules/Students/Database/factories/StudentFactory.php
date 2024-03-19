<?php

namespace Modules\Students\Database\factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Parents\Entities\Guardian;
use Illuminate\Support\Str;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Students\Entities\Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {

        return [
            'class' => "tas3",
            'school' => "icr school",
            'weaknesses_subjects' => "subject 1 , subject 2 , subject 3 ",
            'strong_subjects' => "subject 1 , subject 2 , subject 3 ",
            'father_name' => "icr",
            'mother_name' => "icr",
            'address' => "icr - syria",
            'birthday' => Carbon::parse('2000-01-01'),
            'city' => Str::random(10),
            'user_id' =>  User::all()->where('role_id', 1)->random()->id,
            'guardian_id' => Guardian::all()->random()->id,
            'points' => $this->faker->numerify(),
            'balance' =>  $this->faker->numerify(),
        ];
    }
}
