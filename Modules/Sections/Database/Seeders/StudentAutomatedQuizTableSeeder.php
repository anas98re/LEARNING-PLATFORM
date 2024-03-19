<?php

namespace Modules\Sections\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Students\Entities\StudentAutomatedQuiz;

class StudentAutomatedQuizTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentAutomatedQuiz::factory()
        ->count(10)
        ->create();
    }
}
