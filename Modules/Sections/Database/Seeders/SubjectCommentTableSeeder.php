<?php

namespace Modules\Sections\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Sections\Entities\Subjects\SubjectComment;

class SubjectCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubjectComment::factory()
        ->count(10)
        ->create();
}
}
