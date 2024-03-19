<?php

namespace Modules\Admin\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LastOffersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Admin\Entities\LastOffer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'offer_text' =>  [
                'en' => 'this is nothing ',
                'ar' => "هذه المعلومات تجريبية من لوحة التحكم ",
            ]
            ,
            'offer_image'=>$this->faker->imageUrl() ,
        ];
    }
}

