<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class EditTraditionalQuizRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'unit_id' => ['required', Rule::exists('units', 'id')],
            'lesson_id' => [Rule::exists('lessons', 'id')], //for v2
            'subject_id' => [Rule::exists('subjects', 'id')], // for v2 
            'description' => 'required',
            'isFinal' => 'required|boolean',
            'isAboveLevel' => 'required|boolean',
            'correction_Ladder_file' => 'required|file',
            'nameOfQuiz' => 'required',
            'points' => 'required|integer',
            'duration' => 'required|integer|gt:0',
            'transable' => 'required|boolean',
        ];
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

    public function messages()
    {

        if (App::getLocale() == 'ar') {
            return [
                'unit_id.exists' => 'يجب اختيار وحدة موجودة للامتحان التقليدي',
                'unit_id.required' => 'يجب اختيار وحدة للامتحان التقليدي',
                'description.required' => 'يجب كتابة وصف للامتحان التقليدي.',
                'isFinal.required' => 'يجب اختيار فيما إذا كان الامتحان نهائي أم لا.',
                'isAboveLevel.required' => 'يجب اختيار فيما إذا كانت العلامة فوق المستوى.',
                'correction_Ladder_file.required' => 'يجب رفع سلم التصحيح.',
                'correction_Ladder_file.file' => 'يجب أن يكون سلم التصحيح ملف.',
                'nameOfQuiz.required' => 'يجب كتابة اسم للامتحان التقليدي.',
                'points.required' => 'يجب وضع علامة للامتحان التقليدي .',
                'duration.required' => 'يجب وضع مدّة للامتحان التقليدي .',
                'duration.integer' => 'يجب أن تكون المدّة رقم صحيح موجب .',
                'duration.gt' => 'يجب أن تكون المدّة رقم صحيح موجب .',
                'transable.required' => 'يجب اختيار لغة التطبيق.',
                'transable.boolean' => 'يجب اختيار لغة واحدة إما العربية أو الانكليزية.',

            ];
        }
        if (App::getLocale() == 'en') {
            return Parent::messages();
        }
    }
}
