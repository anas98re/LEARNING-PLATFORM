<?php

namespace Modules\Admin\Database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Admin\Entities\TransferCenter;

class TransferCenterCodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Admin\Entities\TransferCenterCode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $transfer_center = TransferCenter::all()->random();
        $nameCode = substr($transfer_center->name, 0, 5);
        return [
            'transfer_center_id' => $transfer_center->id,
            'code' => $nameCode . $this->faker->regexify('[A-Za-z0-9]{15}'),
            'is_transfer' =>  $this->faker->boolean(false),
            'balance' =>  $this->faker->numerify(),
        ];
    }
}
