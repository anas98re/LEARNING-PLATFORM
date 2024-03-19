<?php

namespace Modules\Sections\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Sections\Entities\Lessons\LessonComment;

class LessonCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LessonComment::factory()
            ->count(10)
            ->create();
    }
}
