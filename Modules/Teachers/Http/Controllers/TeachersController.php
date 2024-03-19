<?php

namespace Modules\Teachers\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Teachers\Http\Requests\UpdatePasswordRequest;
use Modules\Teachers\Entities\Teacher;
use Modules\Teachers\Http\Transformers\TeacherProfileRessorce;
use Modules\Teachers\Http\Transformers\TeacherResource;

class TeachersController extends ApiController
{
    public function get_teacher_by_id($id)
    {
        if (Teacher::find($id)) {
            $teacher = Teacher::where('teachers.id', $id)
                ->with('user')
                ->get();
            return $this->success(TeacherResource::collection([$teacher[0]])[0]);
        }

        return $this->error(
            ["There's no such teacher"],
            "There's no such teacher",
            204
        );
    }

    public function update_teacher_password(UpdatePasswordRequest $request)
    {
        $user = auth('sanctum')->user();
        $guardian = Teacher::where('user_id', $user->id)->get();
        if (!empty($guardian)) {
            $user = User::find($user->id);
            $user->password = Hash::make($request->new_password);
            $user->update();
            $response = [
                'user' => $user,
            ];
            return $this->success($response, 200);
        } else {
            return $this->error('Can not access', "There's no such parents", 401);
        }
    }
    public function get_teacher_profile()
    {
        $user = auth('sanctum')->user();
        $teacher = Teacher::where('user_id', $user->id)->with('user')->get();
        if (!empty($teacher)) {
            return $this->success(TeacherProfileRessorce::collection($teacher), 200);
        } else {
            return $this->error('Can not access', "There's no such teacher", 401);
        }
    }
}
