<?php

namespace Modules\Teachers\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            'user_id' =>  User::where('role_id', 2)->inRandomOrder()->first()->id,
            'subjects_counts' => random_int(1, 100),
        ]);
    }
}
