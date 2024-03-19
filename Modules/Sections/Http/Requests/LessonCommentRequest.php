<?php

namespace Modules\Sections\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class LessonCommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comment' => 'required',
            'lesson_id' => 'required|exists:lessons,id',
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'comment.required' => 'يجب كتابة تعليق',
                'lesson_id.required' => 'يجب اختيار درس',
                'lesson_id.exists' => 'يجب أن يكون الدرس موجود',
            
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
