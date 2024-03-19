<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserOpinion>
 */
class UserOpinionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userRandom = User::all()->random();
        return [

            'user_id'  => $userRandom->id,
            'user_image' => $userRandom->image,
            'opinion' =>  [
                'en' => $this->faker->text(),
                'ar' => "arabic_text",
            ]

        ];
    }
}
