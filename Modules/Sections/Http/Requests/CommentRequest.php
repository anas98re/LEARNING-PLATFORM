<?php

namespace Modules\Sections\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class CommentRequest extends FormRequest
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
                'limit.min' => 'يجب كتابة كلمة سر جديدة',
                'limit.max' => 'يجب كتابة كلمة سر جديدة',
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
