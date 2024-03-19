<?php

namespace Modules\Sections\Http\Requests;

use Illuminate\Support\Facades\App;

use Illuminate\Foundation\Http\FormRequest;

class GetAllAutomatedQuizzesQuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'limit' => 'required|integer|min:2|max:19'

        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'limit.required' => 'يجب كتابة حدّ',
                'limit.integer' => 'يجب أن يكون الحدّ عدد صحيح',
                'limit.min' => 'يجب أن يكون الحد الأدنى للحد 2',
                'limit.max' => 'يجب أن يكون الحد الأعلى للحد 19',
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
