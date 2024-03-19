<?php

namespace Modules\Sections\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Sections\Entities\TraditionalQuizQuestionFile;

class TraditionalQuizQuestionFileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TraditionalQuizQuestionFile::factory()
            ->count(10)
            ->create();
    }
}
