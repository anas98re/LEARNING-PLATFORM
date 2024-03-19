<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class UpdateAutomatedQuizQuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'transable' => 'required',
            'question' => 'required',
            'automated_quiz_question_id' => 'required|exists:automated_quiz_questions,id',
            'point' => 'required|numeric',
            'options' => 'required|array|min:4|max:4',
            'options.*.answear' => 'required',
            'options.*.is_true' => 'required|boolean',
            'options.*.id' => 'required|exists:aqq_options,id',
       ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'question.required' => 'يجب كتابة سؤال',

                'point.required' => 'يجب كتابة علامة',
                'point.numeric' => 'يجب أن تكون العلامة رقم',

                'aqq_option.required' => 'يجب كتابة خيارات الأسئلة المؤتمتة',
                'aqq_option.min' => 'يجب أن تكون الخيارات 4 لا أقل ولا أكثر',
                'aqq_option.max' => 'يجب أن تكون الخيارات 4 لا أقل ولا أكثر',

                'aqq_option.*.id.required' => 'يجب اختيار خيار للسؤال',
                'aqq_option.*.id.exists' => 'يجب أن يكون الخيار موجود',

                'aqq_option.*.answear.required' => 'يجب اختيار اجابة واحدة فقط',

                'aqq_option.*.aqq_id.required' => 'يجب اختيار سؤال',
                'aqq_option.*.aqq_id.exists' => 'يجب أن يكون السؤال موجود',


                'aqq_option.*.is_true.required' => 'يجب اختيار جواب واحد صحيح من الخيارات',
                'aqq_option.*.is_true.boolean' => 'يجب أن تكون قيمة الخيار الصحيح إما 0 أو 1', //

                'automated_quiz_id.required' => 'يجب اختيار امتحان مؤتمت',
                'automated_quiz_id.exists' => 'يجب أن يكون الامتحان المؤتمت موجود',
            ];
        }
        if (App::getLocale() == 'en') {
            return Parent::messages();
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
