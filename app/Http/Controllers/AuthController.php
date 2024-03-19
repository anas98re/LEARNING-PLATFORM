<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\Parents\Entities\Guardian;
use Modules\Students\Entities\Student;
use Modules\Teachers\Entities\Teacher;

class AuthController extends ApiController
{
    function login(LoginRequest $request)
    {

        $user = User::where('email', $request->username)
            ->orWhere('username', $request->username)
            ->where('role_id', $request->role_id)
            ->first();
        // if (!$user || !Hash::check($request->password, $user->password)) {
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->error([
                'message' => 'These credentials do not match our records.'
            ], 'These credentials do not match our records.', 404);
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        switch ($request->role_id) {
            case 1:
                $student = Student::with('user')->where('user_id', $user->id)->first();
                $response = [
                    'success' => true,
                    'user_as_student' => $student,
                    'token' => $token
                ];
                break;

            case 2:
                $teacher = Teacher::with('user')->where('user_id', $user->id)->first();
                $response = [
                    'success' => true,
                    'user_as_teacher' => $teacher,
                    'token' => $token
                ];
                break;
            case 3:
                $guardian = Guardian::with('user')->where('user_id', $user->id)->first();
                $response = [
                    'success' => true,
                    'user_as_guardian' => $guardian,
                    'token' => $token
                ];
                break;
        }
        return $this->success($response, 200);
    }
}
