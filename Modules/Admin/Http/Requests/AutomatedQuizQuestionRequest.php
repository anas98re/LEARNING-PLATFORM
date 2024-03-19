<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class AutomatedQuizQuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question' => 'required',
            'point' => 'required|numeric',
            'options' => 'required|array|min:4|max:4',
            'options.*.answear' => 'required',
            'options.*.is_true' => 'required|boolean',
            'automated_quiz_id' => 'required|exists:automated_quizzes,id',
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'question.required' => 'يجب كتابة سؤال للفحص المؤنمت',
                'point.required' => 'يجب كتابة علامة للفحص المؤتمت',
                'point.numeric' => 'يجب أن تكون العلامة رقم صحيح',
                'options.required' => 'يجب كتابة اختيارات.',
                'options.max' => 'يجب أن تكون الاختيارات على الأكثر أربع خيارات',
                'options.min' => 'يجب أن تكون الاختيارات على الأقل اربع خيارات',
                'options.*.is_true.required' => 'يجب أن يكون هناك جواب واحد صحيح فقط',
                'options.*.answear.boolean' => 'يجب ان يختار الطالب خيار واحد فقط',
                'automated_quiz_id.required' => 'يجب اختيار فحص مؤتمت ',
                'automated_quiz_id.exists' => 'يجب اختيار فحص مؤتمت موجود',
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
