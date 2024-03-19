<?php

namespace Database\Seeders;

use App\Models\UserOpinion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserOpinionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserOpinion::factory()
            ->count(10)
            ->create();
    }
}