<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\LessonCommentRequest;
use Modules\Admin\Http\Requests\SubjectCommentRequest;
use Modules\Admin\Http\Requests\unitCommentRequest;
use Modules\Sections\Entities\Lessons\LessonComment;
use Modules\Sections\Entities\Subjects\SubjectComment;
use Modules\Sections\Entities\Units\UnitComment;
use Modules\Sections\Transformers\LessonCommentResource;
use Modules\Sections\Transformers\SubjectCommentResource;
use Modules\Sections\Transformers\UnitCommentResource;

class CommentController extends ApiController
{
    //Create a comment for Lesson
    public function CreateA_CommentForLesson(LessonCommentRequest $request)
    {
        $data = $request->all();
        $data['comment'] = $request->transable == 0 ?
            ["ar" => $data['comment'], "en" => ''] :
            ["ar" => $data['comment'], "en" => $data['comment_en']];

        $lessonComment = LessonComment::create($data);
        return $this->success(new LessonCommentResource($lessonComment));
    }

    //Update a comment for Lesson
    public function updateA_CommentForLesson(LessonCommentRequest $request, $id)
    {

        $lesssonComment = LessonComment::find($id);
        if ($lesssonComment) {
            $data = $request->all();
            $data['comment'] = $request->transable == 0 ?
                ["ar" => $data['comment'], "en" => ''] :
                ["ar" => $data['comment'], "en" => $data['comment_en']];
            $lesssonComment->update($data);
            return $this->success(new LessonCommentResource($lesssonComment));
        } else {
            return $this->error(["The lesssonComment does not exist"], "The lesssonComment does not exist", 204);
        }
    }
    //delete a comment for Lesson
    public function deletedA_CommentForLesson($id)
    {

        $LessonComment = LessonComment::find($id);
        if ($LessonComment) {
            $LessonComment->delete();
            return $this->success('The deletion process has been completed successfully');
        } else {
            return $this->error(["The Lesson Comment does not exist"], "The Lesson Comment does not exist", 204);
        }
    }



    //Create a comment for Unit
    public function CreateA_CommentForUnit(unitCommentRequest $request)
    {
        $data = $request->all();
        $data['comment'] = $request->transable == 0 ?
            ["ar" => $data['comment'], "en" => ''] :
            ["ar" => $data['comment'], "en" => $data['comment_en']];

        $unitComment = UnitComment::create($data);
        return $this->success(new UnitCommentResource($unitComment));
    }

    //Update a comment for Unit
    public function updateA_CommentForUnit(unitCommentRequest $request, $id)
    {

        $UnitComment = UnitComment::find($id);
        if ($UnitComment) {
            $data = $request->all();
            $data['comment'] = $request->transable == 0 ?
                ["ar" => $data['comment'], "en" => ''] :
                ["ar" => $data['comment'], "en" => $data['comment_en']];
            $UnitComment->update($data);
            return $this->success(new UnitCommentResource($UnitComment));
        } else {
            return $this->error(["The Unit Comment does not exist"], "The Unit Comment does not exist", 204);
        }


        //  return $this->sendResponse(new unitCommentCollection($unitComment), 'LessonComment Updated successullly ');
    }
    //delete a comment for Unit
    public function deletedA_CommentForUnit($id)
    {
        $UnitComment = UnitComment::find($id);
        if ($UnitComment) {
            $UnitComment->delete();
            return $this->success('The deletion process has been completed successfully');
        } else {
            return $this->error(["The Unit Comment does not exist"], "The Unit Comment does not exist", 204);
        }
    }


    //Create a comment for Material
    public function CreateA_CommentForSubjects(SubjectCommentRequest $request)
    {
        $data = $request->all();
        $data['comment'] = $request->transable == 0 ?
            ["ar" => $data['comment'], "en" => ''] :
            ["ar" => $data['comment'], "en" => $data['comment_en']];

        $SubjectComment = SubjectComment::create($data);
        return $this->success(new SubjectCommentResource($SubjectComment));
    }

    //Update a comment for Material
    public function updateA_CommentForSubjects(SubjectCommentRequest $request, $id)
    {
        $SubjectComment = SubjectComment::find($id);
        if ($SubjectComment) {
            $data = $request->all();
            $data['comment'] = $request->transable == 0 ?
                ["ar" => $data['comment'], "en" => ''] :
                ["ar" => $data['comment'], "en" => $data['comment_en']];
            $SubjectComment->update($data);
            return $this->success(new SubjectCommentResource($SubjectComment));
        } else {
            return $this->error(["The Subject Comment does not exist"], "The Subject Comment does not exist", 204);
        }
    }
    //delete a comment for Material
    public function deletedA_CommentForSubjects($id)
    {
        $SubjectComment = SubjectComment::find($id);
        if ($SubjectComment) {
            $SubjectComment->delete();
            return $this->success('The deletion process has been completed successfully');
        } else {
            return $this->error(["The Subject Comment does not exist"], "The Subject Comment does not exist", 204);
        }
    }
}
