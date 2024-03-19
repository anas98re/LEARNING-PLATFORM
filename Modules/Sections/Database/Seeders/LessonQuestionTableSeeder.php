<?php

namespace Modules\Sections\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Sections\Entities\Lessons\LessonQuestion;

class LessonQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LessonQuestion::factory()
            ->count(10)
            ->create();
    }
}
