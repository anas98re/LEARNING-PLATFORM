<?php

namespace Modules\Students\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Students\Entities\StudentSpend;

class StudentSpendTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentSpend::factory()
            ->count(10)
            ->create();
    }
}
