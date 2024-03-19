<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Http\Resources\teacher\teacherCollection;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\GetAllLimitRequest;
use Modules\Admin\Http\Requests\TeacherRequest;
use Modules\Admin\Transformers\teacherResource;
use Modules\Sections\Entities\Lessons\Lesson;
use Modules\Teachers\Entities\Teacher;
use Modules\Teachers\Http\Transformers\TeacherResource as TransformersTeacherResource;

class TeacherController extends ApiController
{
    public function getAllTeachers(GetAllLimitRequest $request)
    {
        $Teacher = Teacher::with('user')->paginate($request->limit);
        if ($Teacher) {
            return $this->success(TransformersTeacherResource::collection($Teacher));
        } else {
            return $this->error(["The Teacher does not exist"], "The Teacher does not exist", 204);
        }
        // return $this->sendResponse($Teacher, 'Teachers returns With pagination 15 successullly');
    }
    public function addTeacher(TeacherRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('public/users/teacher');
        }
        $data['password'] = Hash::make($request->password);
        $data['role_id'] = 2;
        $User = User::create($data);
        $data['user_id'] =  $User->id;
        $data['description'] = $request->transable == 0 ?
            ["ar" => $data['description'], "en" => ''] :
            ["ar" => $data['description'], "en" => $data['description_en']];
        $Teacher = Teacher::create($data);
        $newTeacher = Teacher::with('user')->where('id', $Teacher->id)->first();
        if ($newTeacher) {
            return $this->success(new TransformersTeacherResource($newTeacher));
        } else {
            return $this->error(["The Teacher does not exist"], "The Teacher does not exist", 204);
        }
    }

    public function updateTeacher(teacherRequest $request, $id)
    {
        $data = $request->all();
        $teacher = Teacher::find($id);
        if ($teacher) {
            $data['description'] = $request->transable == 0 ?
                ["ar" => $data['description'], "en" => ''] :
                ["ar" => $data['description'], "en" => $data['description_en']];
            $teacher->update($data);
            $user = User::with('teacher')->find($teacher->user_id);
            $data['password'] = Hash::make($request->password);
            $path = null;
            if ($user->image &&  Storage::exists($user->image)) {
                Storage::delete($user->image);
            }
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('public/users/teacher');
            }
            $data['image'] = $path;
            $user->update($data);
            $newTeacher = Teacher::with('user')->find($id);

            return $this->success(new TransformersTeacherResource($newTeacher));
        } else {
            return $this->error(["The Teacher does not exist"], "The Teacher does not exist", 204);
        }
        //  return $teacher;
        // return $this->sendResponse(new teacherCollection($user), 'Teacher Updated successullly ');
    }

    public function deletedteacher($id)
    {
        $teacher = Teacher::find($id);
        if ($teacher) {
            $user = User::find($teacher->user_id);

            if ($user->image && Storage::exists($user->image)) {

                Storage::delete($user->image);
            }
            $teacher->delete();
            $user->delete();
            return $this->success('The deletion process has been completed successfully');
        } else {
            return $this->error(["The Teacher does not exist"], "The Teacher does not exist", 204);
        }
    }
}
