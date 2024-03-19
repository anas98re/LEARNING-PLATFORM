<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Faqs;
use Modules\Admin\Http\Requests\FaqsRequest;
use Modules\Admin\Transformers\FaqsResource;

class FaqsController extends ApiController
{
    public function add_faqs(FaqsRequest $request)
    {
        $data = $request->all();
        $data['question'] = $request->transable == 0 ?
            ["ar" => $data['question'], "en" => ''] :
            ["ar" => $data['question'], "en" => $data['question_en']];
        $data['answer'] = $request->transable == 0 ?
            ["ar" => $data['answer'], "en" => ''] :
            ["ar" => $data['answer'], "en" => $data['answer_en']];
        $Faqs = Faqs::create($data);
        return $this->success(new FaqsResource($Faqs));
    }
    public function update_faqs(FaqsRequest $request, $id)
    {
        $Faqs = Faqs::find($id);
        if ($Faqs) {
            $data = $request->all();
            $data['question'] = $request->transable == 0 ?
                ["ar" => $data['question'], "en" => ''] :
                ["ar" => $data['question'], "en" => $data['question_en']];
            $data['answer'] = $request->transable == 0 ?
                ["ar" => $data['answer'], "en" => ''] :
                ["ar" => $data['answer'], "en" => $data['answer_en']];
            if (!$request->subject_id) {
                $data['subject_id'] = null;
            }
            if (!$request->unit_id) {
                $data['unit_id'] = null;
            }
            if (!$request->lesson_id) {
                $data['lesson_id'] = null;
            }
            $Faqs->update($data);
            return $this->success(new FaqsResource($Faqs));
        } else {
            return $this->error(["The Faqs does not exist"], "The Faqs does not exist", 204);
        }
    }
    public function deleted_faqs($id)
    {
        $Faqs = Faqs::find($id);
        if ($Faqs) {
            $Faqs->delete();
            return $this->success('The deletion process has been completed successfully');
        } else {
            return $this->error(["The Faqs does not exist"], "The Faqs does not exist", 204);
        }
    }
}
