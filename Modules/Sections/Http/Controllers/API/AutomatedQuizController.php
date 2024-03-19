<?php

namespace Modules\Sections\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\ApiController;
use Modules\Sections\Entities\AutomatedQuiz;
use Modules\Sections\Http\Requests\AutomatedQuizByUnitRequest;
use Modules\Sections\Http\Requests\GetAllAutomatedQuizzesRequest;
use Modules\Sections\Transformers\AutomatedQuizResource;

class AutomatedQuizController extends ApiController
{

    public function get_all_above_level_automated_quiz_by_unit_id(AutomatedQuizByUnitRequest $request)
    {
        $quizes = AutomatedQuiz::where('unit_id', $request->unit_id)->
        where('isAboveLevel', '>', 0)->paginate($request->limit);
        if ($quizes) {
            return  $this->success(AutomatedQuizResource::collection($quizes), 200);
        } else {
            return  $this->error(["There's no such quizzes"], "There's no such quizzes", 204);
        }
    }
    public function get_all_final_automated_quiz_by_unit_id(AutomatedQuizByUnitRequest $request)
    {
        $quizes = AutomatedQuiz::where('unit_id', $request->unit_id)->
        where('isFinal', '>', 0)->paginate($request->limit);
        if ($quizes) {
            return  $this->success(AutomatedQuizResource::collection($quizes), 200);
        } else {
            return  $this->error(["There's no such quizzes"], "There's no such quizzes", 204);
        }
    }
    
    public function get_all_automated_quizzes(GetAllAutomatedQuizzesRequest $request)
    {
        $automated_quizzes = AutomatedQuiz::paginate($request->limit);
        if ($automated_quizzes) {
            return  $this->success(AutomatedQuizResource::collection($automated_quizzes), 200);
        } else {
            return  $this->error(["There's no such Automated quizzes"], "There's no such Automated quizzes", 204);
        }
    }
}
