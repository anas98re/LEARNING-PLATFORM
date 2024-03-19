<?php

namespace Modules\Sections\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Sections\Entities\Lessons\Lesson;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lesson::factory()
            ->count(10)
            ->create();
    }
}
