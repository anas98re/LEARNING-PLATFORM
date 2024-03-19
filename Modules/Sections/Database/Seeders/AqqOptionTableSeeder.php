<?php

namespace Modules\Sections\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Sections\Database\factories\AqqOptionFactory;
use Modules\Sections\Entities\AqqOption;

class AqqOptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AqqOption::factory()
        ->count(10)
        ->create();
    }
}
