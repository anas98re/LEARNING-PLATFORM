<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rules\RequiredIf;

class FaqsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $required_chose_only_one = '';
        if (!$this->lesson_id && !$this->unit_id && !$this->subject_id) {
            $required_error = 'required';
        } else {
            $required_error = '';
        }
        if (!$this->lesson_id  && $this->unit_id && $this->subject_id || $this->lesson_id  && $this->unit_id && !$this->subject_id || $this->lesson_id  && !$this->unit_id && $this->subject_id || $this->lesson_id  && $this->unit_id && $this->subject_id) {
            $required_chose_only_one = 'required';
        }
        return [
            'question' => 'required',
            'answer' => 'required',
            'unit_id' => 'exists:units,id',
            'lesson_id' =>  'exists:lessons,id',
            'subject_id' => 'exists:subjects,id',
            'error' => $required_error,
            'chose_only_one' => $required_chose_only_one,

        ];
    }
    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'error.required' => 'يرجى اختيار القسم الذي تريد ان تضع عليه السؤال الشائع اما درس او المادة او الوحدة',
                'subject_id.exists' => 'ان المادة المدخلة غير موجودة',
                'unit_id.exists' => 'ان الوحدة المدخلة غير موجودة',
                'lesson_id.exists' => 'ان الدرس المدخل غير موجود',
                'question.required' => 'يجب ادخال السؤال الشائع',
                'chose_only_one.required' => 'يجب اختيار اما وحدة او مادة او درس لا يمكن ان يكون السؤال تابع لاكثر من مكان واحد'
            ];
        }
        if (App::getLocale() == 'en') {
            return [
                'error.required' => 'Please choose the section on which you want to put the FAQ, either a lesson, subject or unit',
                'chose_only_one.required' =>  'Choosing a place for a unit, subject, or lesson. The question cannot be affiliated with more than one place
                '
            ];
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
