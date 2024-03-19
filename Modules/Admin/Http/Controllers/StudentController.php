<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\GetAllLimitRequest;
use Modules\Admin\Http\Requests\StudentsRequest;
use Modules\Admin\Transformers\StudentsResource;
use Modules\Students\Entities\Student;

class StudentController extends ApiController
{
    public function getAllStudents(GetAllLimitRequest $request)
    {
        $Student = Student::with('user')->paginate($request->limit);
        if ($Student) {
            return $this->success(StudentsResource::collection($Student));
        }
        return $this->error(["The Student does not exist"], "The Student does not exist", 204);
        // return $this->sendResponse($Student, 'Students returns With pagination 15 successullly');
    }
    public function updateStudent(StudentsRequest $request, $id)
    {
        $data = $request->all();
        $Student = Student::find($id);

        if ($Student) {
            $user = User::find($Student->user_id);
            $data['password'] = Hash::make($request->password);
            $path = null;
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('public/students/students_images');
            }
            $data['image'] = $path;

            $user->update($data);
            $Student->update($data);
            return $this->success(new StudentsResource($Student));
        } else {
            return $this->error(["The Student does not exist"], "The Student does not exist", 204);
        }
    }
    public function deletedStudent($id)
    {
        $Student = Student::find($id);
        if ($Student) {
            $user = User::find($Student->user_id);
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }
            $Student->delete();
            $user->delete();
            return $this->success('The deletion process has been completed successfully');
        } else {
            return $this->error(["The Student does not exist"], "The Student does not exist", 204);
        }
        // return $this->sendResponse(new teacherCollection($teacher), 'teacher Deleted successullly ');
    }
}
