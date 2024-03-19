<?php

namespace Modules\Sections\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Sections\Entities\TraditionalQuiz;

class TraditionalQuizTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TraditionalQuiz::factory()
            ->count(10)
            ->create();
    }
}
