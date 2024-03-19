<?php

namespace Modules\Parents\Database\factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuardianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Parents\Entities\Guardian::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
         //   'user_id' =>  User::where('role_id', 3)->inRandomOrder()->first()->id,
           'user_id' =>  User::all()->random()->first()->id,
        ];
    }
}

