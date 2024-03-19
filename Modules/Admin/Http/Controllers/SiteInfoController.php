<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\LastOffer;
use Modules\Admin\Entities\SiteInfo;
use Modules\Admin\Http\Requests\ContactUsInformationRequest;
use Modules\Admin\Http\Requests\GetAllLastOffersRequest;
use Modules\Admin\Http\Requests\SiteInfoRequest;
use Modules\Admin\Transformers\LastOffersResource;

class SiteInfoController extends ApiController
{

    public function edit(SiteInfoRequest $request)
    {
        $data = $request->all();
        $keys_of_site_info = [
            'main_video', 'aboutUs', 'explainer_video', 'number_of_students',
            'number_of_lessons', 'number_of_subjects',
            'facebook', 'youtube', 'whatsapp', 'instgram',
            'terms_and_laws', 'the_vision', 'the_goal',
            'junior_certificate', 'highschool_scientific_certificate',
            'highschool_literary_certificate', 'lang_description1',
            'lang_description2'
        ];
        SiteInfo::truncate() ;

        foreach ($keys_of_site_info as $key_of_site_info) {
            // SiteInfo::where('info', $key_of_site_info)
            // ->update(
            //     [
            //         'info_value' => $data[$key_of_site_info]
            //     ]
            // );
            SiteInfo::create(['info' =>  $key_of_site_info, 'info_value' => 
            [
                "ar"=> $data[$key_of_site_info]  ,
                "en"=>$request->transable=='0' ? '':$data[$key_of_site_info.'_en'] ,
            ]]);
        }


        return $this->success($data, 200);
    }

    public function get_terms_and_laws()
    {
        $terms_and_laws = SiteInfo::whereIn('info', array('terms_and_laws',
        'main_video'))->pluck('info_value', 'info');
        return $this->success($terms_and_laws, 200);
    }
    
    public function get_last_offers(GetAllLastOffersRequest $request)
    {
        $last_offers = LastOffer::paginate($request->limit);
        if ($last_offers->first()) {
            return $this->success(LastOffersResource::collection($last_offers));
        } else {
            return $this->error(["There'\s no last_offers"], "There'\s no last_offers", 204);
        }
    }
    public function get_about_us_site_info()
    {
        $about_us = SiteInfo::whereIn('info', array(
            'main_video', 'the_goal', 'the_vision',
            'aboutUs', 'highschool_literary_certificate', 'highschool_scientific_certificate', 'junior_certificate',
            'lang_description1', 'lang_description2', 'number_of_lessons',
            'number_of_subjects', 'number_of_students'
        ))
            ->pluck('info_value', 'info');
        return $this->success($about_us, 200);
    }
    public function get_home_site_info()
    {
        $site_info = SiteInfo::whereIn('info', ['main_video', 'aboutUs', 'explainer_video', 'number_of_students', 'number_of_lessons', 'number_of_subjects', 'facebook', 'youtube', 'whatsapp', 'instgram', 'lastoffers'])
            ->pluck('info_value', 'info');


        return $this->success($site_info, 200);
    }
    public function get_social_info()
    {
        $social_info = SiteInfo::whereIn('info', ['facebook', 'youtube', 'whatsapp', 'instgram'])
            ->pluck('info_value', 'info');
        return $this->success($social_info, 200);
    }
}
