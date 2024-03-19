<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\LessonRequest;
use Modules\Admin\Transformers\lessonResource;
use Modules\Admin\Transformers\parentResource;
use Modules\Sections\Entities\Lessons\Lesson;
use Modules\Sections\Transformers\LessonResource as TransformersLessonResource;
use Modules\Sections\Transformers\LessonResourceCollection;

class LessonController extends ApiController
{
    // public function getAllLessonsByUnitId(Request $request)
    // {

    //     if ($request->has('unit_id') && is_numeric($request->unit_id) && Lesson::where('unit_id', $request->unit_id)->exists()) {
    //         $lessons = Lesson::where('unit_id', $request->unit_id)->get();
    //         return  $this->respond(LessonCollection::collection($lessons), 200);
    //     } else {
    //         return $this->respondError(204, "The unit id must be integer and exists");
    //     }
    // }


    // public function show($id)
    // {
    //     $lesson = Lesson::findOrFail($id);
    //     return $this->respond(LessonCollection::collection([$lesson])[0]);
    // }

    // public function getFreeLessonsByUnitId(Request $request)
    // {

    //     if ($request->has('unit_id') && is_numeric($request->unit_id) && Lesson::where('unit_id', $request->unit_id)->where('isFree', 1)->exists()) {
    //         $lessons = Lesson::where('unit_id', $request->unit_id)->where('isFree', 1)->get();
    //         return  $this->respond(LessonCollection::collection($lessons), 200);
    //     } else {
    //         return $this->respondError(204, "The unit id must be integer and exists");
    //     }
    // }

    public function CreateLesson(LessonRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('public/Lesson/cover');
        }
        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('public/Lesson/video');
        }
        $data['name'] = $request->transable == 0 ?
            ["ar" => $data['name'], "en" => ''] :
            ["ar" => $data['name'], "en" => $data['name_en']];
        $data['description'] = $request->transable == 0 ?
            ["ar" => $data['description'], "en" => ''] :
            ["ar" => $data['description'], "en" => $data['description_en']];
        $data['what_we_will_learn'] = $request->transable == 0 ?
            ["ar" => $data['what_we_will_learn'], "en" => ''] :
            ["ar" => $data['what_we_will_learn'], "en" => $data['what_we_will_learn_en']];
        $Lesson = Lesson::create($data);
        return $this->success(new LessonResource($Lesson));
    }


    public function updateLesson(lessonRequest $request, $id)
    {

        $lesson = Lesson::find($id);
        if ($lesson) {
            $data = $request->all();
            if ($request->hasFile('cover')) {
                if ($lesson->cover &&  Storage::exists($lesson->cover)) {
                    Storage::delete($lesson->cover);
                }
                $data['cover'] = $request->file('cover')->store('public/Lesson/cover');
            }
            if ($request->hasFile('video')) {
                if ($lesson->video &&  Storage::exists($lesson->video)) {
                    Storage::delete($lesson->video);
                }
                $data['video'] = $request->file('video')->store('public/Lesson/video');
            }
            $data['name'] = $request->transable == 0 ?
                ["ar" => $data['name'], "en" => ''] :
                ["ar" => $data['name'], "en" => $data['name_en']];
            $data['description'] = $request->transable == 0 ?
                ["ar" => $data['description'], "en" => ''] :
                ["ar" => $data['description'], "en" => $data['description_en']];
            $data['what_we_will_learn'] = $request->transable == 0 ?
                ["ar" => $data['what_we_will_learn'], "en" => ''] :
                ["ar" => $data['what_we_will_learn'], "en" => $data['what_we_will_learn_en']];
            $lesson->update($data);
            return $this->success(new LessonResource($lesson));
        } else {
            return $this->error(["The Lesson does not exist"], "The Lesson does not exist", 204);
        }
    }

    public function deletedLesson($id)
    {
        $Lesson = Lesson::find($id);
        if ($Lesson) {
            if ($Lesson->cover && Storage::exists($Lesson->cover)) {

                Storage::delete($Lesson->cover);
            }
            if ($Lesson->video && Storage::exists($Lesson->video)) {

                Storage::delete($Lesson->video);
            }
            $Lesson->delete();
            return $this->success('The deletion process has been completed successfully');
        } else {
            return $this->error(["The Lesson does not exist"], "The Lesson does not exist", 204);
        }
    }
}
