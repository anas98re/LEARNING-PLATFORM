<?php

namespace Modules\Sections\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Sections\Entities\TraditionalQuiz;

class SectionsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SectionTableSeeder::class,
            SubSectionTableSeeder::class,
            SubjectTableSeeder::class,
            UnitTableSeeder::class,
            LessonTableSeeder::class,
            LessonAttachmentTableSeeder::class,
            WebSiteLibraryTableSeeder::class,
            StudentUnitTableSeeder::class,
            StudentLessonTableSeeder::class,
            UnitCommentTableSeeder::class,
            LessonCommentTableSeeder::class,
            LessonQuestionTableSeeder::class,
            SubjectCommentTableSeeder::class,
            StudentSubjectTableSeeder::class,
            AutomatedQuizTableSeeder::class,
            AutomatedQuizQuestionTableSeeder::class,
            AqqOptionTableSeeder::class,
            StudentAutomatedQuizTableSeeder::class,
            StudentAutomatedQuizQuestionTableSeeder::class,
            TraditionalQuizTableSeeder::class,
            TraditionalQuizQuestionFileTableSeeder::class,

        ]);
    }
}
