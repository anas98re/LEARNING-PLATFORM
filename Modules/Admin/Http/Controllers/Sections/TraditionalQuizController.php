<?php

namespace Modules\Admin\Http\Controllers\Sections;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\EditTraditionalQuizRequest;
use Modules\Sections\Entities\TraditionalQuiz;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\CreateTraditionalQuizQuestionFileRequest;
use Modules\Admin\Http\Requests\CreateTraditionalQuizRequest;
use Modules\Sections\Entities\TraditionalQuizQuestionFile;

class TraditionalQuizController extends ApiController
{
    public function edit_traditional_quiz(EditTraditionalQuizRequest $request, $id)
    {

        $traditionalQuiz = TraditionalQuiz::find($id);
        // delete the old file from server
        if ($traditionalQuiz) {
            if (Storage::exists($traditionalQuiz->correction_Ladder_file)) {
                Storage::delete($traditionalQuiz->correction_Ladder_file);
            }
            //then add the new file to server
            if ($request->hasFile('correction_Ladder_file')) {
                $path = $request->file('correction_Ladder_file')
                    ->store('public/admin/correction_Ladder_files');
            }
            $data = $request->all();
            $data['correction_Ladder_file'] = $path;
            $traditionalQuiz->update($data);
            $response = [
                'message' => 'Record was updated successfully',
            ];
            return $this->success($response, 200);
        } else {
            return $this->error(["There's no such traditional quiz"], "There's no such traditional quiz", 204);
        }
    }

    public function delete_traditional_quiz($id)
    {
        $traditionalQuiz = TraditionalQuiz::find($id);
        if ($traditionalQuiz) {

            if (Storage::exists($traditionalQuiz->correction_Ladder_file)) {
                Storage::delete($traditionalQuiz->correction_Ladder_file);
            }
            $traditionalQuiz->delete();
            $response = [
                'message' => 'Record was deleted successfully',
            ];
            return $this->success($response, 200);
        } else {
            return $this->error(["There's no such traditional quiz"], "There's no such traditional quiz", 204);
        }
    }

    public function create_traditional_quiz(CreateTraditionalQuizRequest $request)
    {
        if ($request->hasFile('correction_Ladder_file')) {
            $path = $request->file('correction_Ladder_file')
                ->store('public/admin/correction_Ladder_files');
        }
        $traditionalQuiz = new TraditionalQuiz;
        $traditionalQuiz->unit_id = $request->unit_id;
        // $traditionalQuiz->lesson_id = $request->lesson_id; // for the v2 we will need it
        // $traditionalQuiz->subject_id = $request->subject_id; // for the v2 we will need it
        $traditionalQuiz->isFinal = $request->isFinal;
        $traditionalQuiz->isAboveLevel = $request->isAboveLevel;
        $traditionalQuiz->correction_Ladder_file = $path;
        $traditionalQuiz->points = $request->points;
        $traditionalQuiz->duration = $request->duration;
        $traditionalQuiz->setTranslation('description', 'ar', $request->description)
            ->setTranslation('description', 'en', $request->transable == '0' ? '' : $request->description_en)
            ->setTranslation('nameOfQuiz', 'ar', $request->nameOfQuiz)
            ->setTranslation('nameOfQuiz', 'en', $request->transable == '0' ? '' : $request->nameOfQuiz_en);
        $traditionalQuiz->save();

        return $this->success($traditionalQuiz, 200);
    }
    public function delete_traditional_quiz_question_file_by_traditional_quiz_question_file_id($id)
    {
        $traditional_quiz_question_file = TraditionalQuizQuestionFile::find($id);
        if ($traditional_quiz_question_file) {

            if (Storage::exists($traditional_quiz_question_file->file_link)) {
                Storage::delete($traditional_quiz_question_file->file_link);
            }
            $traditional_quiz_question_file->delete();

            return $this->success('Record was deleted successfully', 200);
        } else {
            return $this->error(["There's no such traditional quiz question file"], "There's no such traditional quiz question file", 204);
        }
    }

    public function create_traditional_quiz_questions_files(CreateTraditionalQuizQuestionFileRequest $request)
    {
        if ($request->hasFile('questions_files')) {
            $questions_files = $request->file('questions_files');
            foreach ($questions_files as $question_file) {
                $path = $question_file->store('admin/traditional_quizzes_questions_files');
                TraditionalQuizQuestionFile::create([
                    'traditional_quiz_id' => $request['traditional_quiz_id'],
                    'file_link' => $path,
                ]);
            }
        }
        $response = [
            'message' => 'question was added successfully',
        ];
        return $this->success($response, 200);
    }
}
