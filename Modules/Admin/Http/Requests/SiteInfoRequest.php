<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class SiteInfoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'main_video' => 'required|url',
            'aboutUs' => 'required|string',
            'explainer_video' => 'required|url',
            'number_of_students' => 'required|Integer|gt:0',
            'number_of_lessons' => 'required|Integer|gt:0',
            'number_of_subjects' => 'required|Integer|gt:0',
            'facebook' => 'required|url',
            'youtube' => 'required|url',
            'whatsapp' => 'required|url',
            'instgram' => 'required|url',
            'terms_and_laws' => 'required|string',
            'transable' => 'required|boolean',
        ];
    }


    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'main_video.required' => 'يجب اختيار رابط للفيديو الرئيسي',
                'main_video.url' => 'يجب وضع رابط للفيديو الرئيسي',

                'aboutUs.required' => 'يجب كتابة وصف عنا',
                'aboutUs.string' => 'يجب أن يكون الوصف عنا نص',

                'explainer_video.required' => 'يجب اختيار رابط لفيديو تعريفي',
                'explainer_video.url' => 'يجب أن يكون الفيديو التعريفي رابط',

                'number_of_students.required' => 'يجب كتابة رقم للطلاب',
                'number_of_students.Integer ' => 'يجب أن يكون رقم الطلاب رقم صحيح',
                'number_of_students.gt ' => 'يجب أن يكون عدد الطلاب أكبر من 0',

                'number_of_lessons.required' => 'يجب كتابة رقم للدروس',
                'number_of_lessons.Integer ' => 'يجب أن يكون رقم الدروس رقم صحيح',
                'number_of_lessons.gt ' => 'يجب أن يكون عدد الدروس أكبر من 0',


                'number_of_questions_per_day.required' => 'يجب كتابة عدد للأسئلة',
                'number_of_questions_per_day.Integer ' => 'يجب أن يكون عدد الأسئلة رقم صحيح',
                'number_of_questions_per_day.gt ' => 'يجب أن يكون رقم الأسئلة أكبر من 0',

                'facebook.required' => 'يجب كتابة رابط للفيسبوك',
                'facebook.url' => 'يجب كتابة "رابط" للفيسبوك',


                'youtube.required' => 'يجب كتابة رابط لليوتيوب',
                'youtube.url' => 'يجب كتابة "رابط" لليوتيوب',


                'whatsapp.required' => 'يجب كتابة رابط للواتساب',
                'whatsapp.url' => 'يجب كتابة "رابط" للواتساب',


                'instgram.required' => 'يجب كتابة رابط للانستغرام',
                'instgram.url' => 'يجب كتابة "رابط" للانستغرام',

                'last_offers.required' => 'يجب كتابة آخر العروض',
                'last_offers.string' => 'يجب أن تكون آخر العروض نص',

                'terms_and_laws.required' => 'يجب كتابة الشروط و القوانين',
                'terms_and_laws.string' => 'يجب أن تكون الشروط و القوانين نص',


            ];
        }
        if (App::getLocale() == 'en') {
            return Parent::messages();
        }
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
