<?php

namespace Modules\Students\Http\Controllers\API;

use App\Http\Controllers\ApiController;

use Modules\Students\Entities\Language;
use Modules\Students\Entities\Student;
use Modules\Students\Entities\StudentLanguage;

class StudentLanguagesController extends ApiController
{
    public function get_all_languages()
    {
        $user = auth('sanctum')->user();
        if (!$user) {
            $data = Language::all();
           return  $this->success($data,200) ; 
        } else {
            $student = Student::where('user_id', $user->id)->first();
            $student_languages_ids = StudentLanguage::where('student_id', $student->id)->pluck('id');
            $data = Language::all()->whereNotIn('id', $student_languages_ids); 
            return $this->success($data,200) ;   
        }
    }
}
