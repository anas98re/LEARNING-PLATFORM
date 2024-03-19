<?php

namespace Modules\Sections\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Modules\Sections\Entities\Units\StudentUnit;
use Modules\Sections\Entities\Units\Unit;
use Modules\Sections\Http\Requests\GetAllAutomatedQuizzesRequest;
use Modules\Sections\Transformers\UnitResource;
use Modules\Students\Entities\Student;

class UnitController extends ApiController
{
    public function get_unit_details_by_unit_id($id)
    {
        $unit = Unit::withSum('lessons', 'duration')->withCount('lessons')->find($id);
        if ($unit) {
            return $this->success(UnitResource::make($unit), 200);
        } else {
            return $this->error(["The unit does not exist"], "The unit does not exist", 204);
        }
    }


    public function get_all_units_by_subject_id(GetAllAutomatedQuizzesRequest $request)
    {
        $user = auth('sanctum')->user();
        if (!$user || $user->role_id != 1) {
            $units = Unit::where('subject_id', $request->subject_id);
            if ($request->has('subject_id') && is_numeric($request->subject_id) && $units->exists()) {
                $units = $units->withSum('lessons', 'duration')->withCount('lessons')->latest('created_at')->paginate($request->limit);
                return  $this->success(UnitResource::collection($units), 200);
            } else {
                return $this->error(["The subject does not exist"], "The subject does not exist", 204);
            }
        } else {
            $student = Student::where('user_id', $user->id)->first();
            $units = StudentUnit::where('subject_id', $request->subject_id)->where('student_id', $student->id);
            if ($request->has('subject_id') && is_numeric($request->subject_id) && $units->exists()) {
                $units = $units->withCount('lessons')->withSum('lessons', 'duration')->latest('created_at')->paginate($request->limit);
                return  $this->success(UnitResource::collection($units), 200);
            } else {
                return $this->error(["The subject does not exist for this student"], "The subject does not exist for this student", 204);
            }
        }
    }
}
