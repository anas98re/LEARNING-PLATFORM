<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                SiteInfoTableSeeder::class,
                TransferCenterTableSeeder::class,
                TransferCenterCodeTableSeeder::class,
                LastOffersTableSeeder::class,
                FaqsTableSeeder::class,


            ]
        );
    }
}
