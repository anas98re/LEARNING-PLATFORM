<?php

namespace Modules\Parents\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Parents\Entities\Guardian;

class ParentsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            GuardianTableSeeder::class
        ]);
    }
}
