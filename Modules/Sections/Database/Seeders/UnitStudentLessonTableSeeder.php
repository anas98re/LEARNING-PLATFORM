<?php

namespace Modules\Sections\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Sections\Entities\UnitStudentLesson;

class UnitStudentLessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnitStudentLesson::factory()
            ->count(10)
            ->create();
    }
}
