<?php

namespace Modules\Sections\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Sections\Entities\WebSiteLibrary;

class WebSiteLibraryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WebSiteLibrary::factory()
            ->count(10)
            ->create();
    }
}
