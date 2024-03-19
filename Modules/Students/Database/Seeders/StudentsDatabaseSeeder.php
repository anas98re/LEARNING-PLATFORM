<?php

namespace Modules\Students\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class StudentsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StudentTableSeeder::class,
            PaymentTableSeeder::class,
            StudentSpendTableSeeder::class,
        ]);
    }
}
