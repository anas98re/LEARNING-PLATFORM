<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\AutomatedQuizeRequest;
use Modules\Sections\Entities\AutomatedQuiz;
use Modules\Sections\Transformers\AutomatedQuizResource;
use Modules\Admin\Http\Transformers\UpdateAutomatedQuizResource;

class AutomatedQuizeController extends ApiController
{
    public function create_automated_quiz(AutomatedQuizeRequest $request)
    {
        // you must check if transable true then you have to 
        $data = $request->all();
        $data['description'] = $request->transable =='0' ? ['ar'=>$request->description
                                                            ,'en'=>'' ] 
                                                            :
                                                            ['ar'=>$request->description
                                                            ,'en'=>$request->description_en ]; 
        $data['nameOfQuiz'] = $request->transable =='0' ? ['ar'=>$request->nameOfQuiz
                                                            ,'en'=>'' ] 
                                                            :
                                                            ['ar'=>$request->nameOfQuiz
                                                            ,'en'=>$request->nameOfQuiz_en ]; 
        AutomatedQuiz::create($data);
        return  $this->success('the recorder has added successfully', 200);
    }

    public function edit_automated_quiz(AutomatedQuizeRequest $request, $id)
    {
        $automated_quiz = AutomatedQuiz::find($id);
        if ($automated_quiz) {
            $data = $request->all();
            $data['description'] = $request->transable =='0' ? ['ar'=>$request->description
                                                                ,'en'=>'' ] 
                                                                :
                                                                ['ar'=>$request->description
                                                                ,'en'=>$request->description_en ]; 
            $data['nameOfQuiz'] = $request->transable =='0' ? ['ar'=>$request->nameOfQuiz
                                                                ,'en'=>'' ] 
                                                                :
                                                                ['ar'=>$request->nameOfQuiz
                                                                ,'en'=>$request->nameOfQuiz_en ]; 
            $automated_quiz->update($data);
            return  $this->success(UpdateAutomatedQuizResource::collection($automated_quiz), 200);
        } else {
            return  $this->error('there no records has this ids', 'There no records has this id', 404);
        }
    }

    public function delete_automated_quiz($id)
    {
        $delete = AutomatedQuiz::find($id);
        if ($delete) {
            $delete->delete();
            return  $this->success('Deleted successfully', 200);
        } else {
            return  $this->error('there no records has this ids', 'There no records has this id', 404);
        }
    }
}
