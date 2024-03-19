<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\Admin\Entities\SiteInfo;

class SiteInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteInfo::truncate() ;
        $keys_of_site_info = [ 'aboutUs',  'terms_and_laws', 'the_vision', 'the_goal', 'junior_certificate', 'highschool_scientific_certificate', 'highschool_literary_certificate', 'lang_description1', 'lang_description2'];
        $keys_of_site_info_that_needs_numbers = [  'number_of_students', 'number_of_subjects', 'number_of_lessons'];
        $keys_of_site_info_that_needs_links = ['main_video', 'explainer_video','facebook', 'youtube', 'whatsapp', 'instgram'];
        foreach ($keys_of_site_info as $info) {
            SiteInfo::create(['info' => $info, 'info_value' => 
            [
                "ar"=>"هذه المعلومات تجريبية من لوحة التحكم  " ,
                "en"=>"here is the final text from cpanel "
            ]]);
        }
        foreach ($keys_of_site_info_that_needs_links as $info) {
            SiteInfo::create(['info' => $info,
             'info_value' =>[
                 "ar"=> 'https://www.youtube.com/watch?v=BuQgxL-LG_U&list=RDMMtzDquDVT7Kc&index=24',
                 "en"=> 'en https://www.youtube.com/watch?v=BuQgxL-LG_U&list=RDMMtzDquDVT7Kc&index=24'
             ]
             ]
              );
        }
        foreach ($keys_of_site_info_that_needs_numbers as $info) {
            SiteInfo::create(['info' => $info, 'info_value' => rand(1, 100)]);
        }
    }
}
