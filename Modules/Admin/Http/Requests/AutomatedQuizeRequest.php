<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rules\RequiredIf;

class AutomatedQuizeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'unit_id' => 'exists:units,id',
            'lesson_id' => 'exists:lessons,id',
            'subject_id' =>  'exists:subjects,id',
            'description' => 'required',
            'isFinal' => 'required|boolean',
            'isAboveLevel' => 'required|boolean',
            'nameOfQuiz' => 'required',
            'points' => 'required',
            'duration' => 'required',
            'transable' => 'required',

        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'unit_id.exists' => 'يجب اختيار وحدة موجودة للامتحان المؤتمت',
                'unit_id.required' => 'يجب اختيار وحدة للامتحان المؤتمت',
                'description.required' => 'يجب كتابة وصف للامتحان المؤتمت.',
                'isFinal.required' => 'يجب اختيار فيما إذا كان الامتحان نهائي أم لا.',
                'isAboveLevel.required' => 'يجب اختيار فيما إذا كانت العلامة فوق المستوى.',
                'correction_Ladder_file.required' => 'يجب رفع سلم التصحيح.',
                'correction_Ladder_file.file' => 'يجب أن يكون سلم التصحيح ملف.',
                'nameOfQuiz.required' => 'يجب كتابة اسم للامتحان المؤتمت.',
                'points.required' => 'يجب وضع علامة للامتحان المؤتمت .',
                'duration.required' => 'يجب وضع مدّة للامتحان المؤتمت .',
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
