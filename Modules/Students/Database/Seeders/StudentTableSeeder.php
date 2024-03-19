<?php

namespace Modules\Students\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Students\Entities\Student;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::factory()
            ->count(10)
            ->create();
        $path = public_path('langs.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);
        // // $this->call("OthersTableSeeder");
    }
}
