<?php

namespace Modules\Students\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Students\Entities\Student;
use Modules\Students\Entities\StudentCertificate;
use Modules\Students\Entities\StudentLanguage;
use Modules\Students\Http\Requests\SignUpUserRequest;
use Illuminate\Http\Request;
use function PHPUnit\Framework\stringContains;

class AuthController extends ApiController
{


    public function signup(SignUpUserRequest $request)
    {

        if ($request->certificates && count($request->certificates) > 8)
            return $this->error(
                'max 8 image',
                "please don't upload more than 8 image",
                422
            );
        $data = $request->all();
        $data['certificates'] = [];
        $data['role_id'] = 1;
        $data['password'] = Hash::make($request->password);
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('public/students/students_images');
            $data['image'] = $image_path;
        }
        $user = User::create($data);
        $data['user_id'] = $user->id;
        $student = Student::create($data);
        if ($request->hasFile('certificates')) {
            $certificates_image = $request->file('certificates');
            foreach ($certificates_image as $image) {
                $StudentCertificate = new StudentCertificate();
                $certificates_path = $image->store('public/students/students_certificates');
                $StudentCertificate->certificate_image = $certificates_path;
                $StudentCertificate->student_id = $student->id;
                $StudentCertificate->save();
            }
        }
        $student_languages = $request->student_languages;
        foreach ($student_languages as $language) {
            $language = json_decode($language, true);
            $language['student_id'] = $student->id;
            StudentLanguage::create($language)->save();
        }
        $student = Student::with('user', 'languages', 'certificates')->where('user_id', $user->id)->first();
        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = [
            'success' => true,
            'student' => $student,
            'token' => $token
        ];
        return $this->success($response, 200);
    }
}
