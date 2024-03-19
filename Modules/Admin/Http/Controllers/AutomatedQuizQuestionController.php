<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\AutomatedQuizQuestionRequest;
use Modules\Admin\Http\Requests\UpdateAutomatedQuizQuestionRequest;
use Modules\Admin\Http\Transformers\UpdateAutomatedQuizQuestionResource;
use Modules\Sections\Entities\AqqOption;
use Modules\Sections\Entities\AutomatedQuizQuestion;
use Modules\Sections\Transformers\AutomatedQuizQuestionResource ;
class AutomatedQuizQuestionController extends ApiController
{
  
    public function add_automated_quiz_question_with_its_options(AutomatedQuizQuestionRequest $request)
    {
        $data = $request->all();
        $aqq = AutomatedQuizQuestion::create($data);
        // echo $data['options'] ; 
        foreach ($data['options'] as $option) {
            echo 1; 
            $option['aqq_id'] = $aqq->id;
            
            AqqOption::create($option);
        }
        return  $this->success('the recorder has added successfully', 200);
    }

    

  

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function edit_automated_quiz_question_with_its_options_by_automated_quiz_question_id (UpdateAutomatedQuizQuestionRequest $request)
    {
        $aqq = AutomatedQuizQuestion::with('aqqOption')->find($request->automated_quiz_question_id);
        $data = $request->all();
        if ($aqq) {
            $aqq->update($request->all());
            foreach ($data['options'] as $option) {
                $option['answear'] = $request->transable =='0' ?
                ["ar" => $option['answear'] , "en"=> ''] :
                ["ar" => $option['answear'] , "en"=> $option['answear_en'] ] ; 
                AqqOption::where('id', $option['id'])->first()->update($option);
            }
            $new_aqq = AutomatedQuizQuestion::with('aqqOption')->find($request->automated_quiz_question_id);
            return  $this->success(UpdateAutomatedQuizQuestionResource::collection($new_aqq), 200);
        } else {
            return  $this->error('there no records has this ids', 'There no records has this id', 404);
        }
    }

    public function delete_automated_quiz_question_with_its_options_by_automated_quiz_question_id ($id)
    {
        $delete = AutomatedQuizQuestion::find($id);
        if ($delete) {
            $delete->delete();
            return  $this->success('Deleted successfully', 200);
        } else {
            return  $this->error('there no records has this ids', 'There no records has this id', 404);
        }
    }

}
