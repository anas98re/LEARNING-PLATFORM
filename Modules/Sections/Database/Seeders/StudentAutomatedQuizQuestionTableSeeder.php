<?php

namespace Modules\Sections\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Sections\Entities\StudentAutomatedQuizQuestion;

class StudentAutomatedQuizQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentAutomatedQuizQuestion::factory()
        ->count(10)
        ->create();
    }
}
