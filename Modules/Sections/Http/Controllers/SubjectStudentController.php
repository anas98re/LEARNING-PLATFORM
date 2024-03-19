<?php

namespace Modules\Sections\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Sections\Entities\Subjects\StudentSubject;
use Modules\Sections\Entities\Subjects\Subject;
use Modules\Sections\Http\Requests\SubjectStudentRequest;
use Modules\Students\Entities\Student;

class SubjectStudentController extends ApiController
{
    public function set_student_subscription_for_the_subject(SubjectStudentRequest $request)
    {
        $user = auth('sanctum')->user();
        $student = Student::where('user_id', $user->id)->first();
        $check = StudentSubject::where('subject_id', $request->subject_id)
            ->where('student_id', $student->id)->exists();
        if ($check)
            return $this->error(
                'you have already subscribed with this subject ',
                'you have already subscribed with this subject ',
                401
            );
        $subject_price = Subject::where('id', $request->subject_id)->first()->price;
        if ($student->balance < $subject_price)
            return $this->error(
                'You do not have enough balance',
                'You do not have enough balance for this subject',
                401
            );
        $recorde = new StudentSubject();
        $recorde->student_id = $student->id;
        $recorde->subject_id = $request->subject_id;
        $recorde->save();
        $student->balance = $student->balance - $subject_price;
        $student->update();
        return $this->success('Subscribed successfully', 200);
    }
}
