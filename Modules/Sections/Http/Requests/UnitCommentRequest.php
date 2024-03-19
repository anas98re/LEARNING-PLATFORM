<?php

namespace Modules\Sections\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class UnitCommentRequest extends FormRequest
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
            'unit_id' => 'required|exists:units,id',
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'unit_id.required' => 'يجب اختيار وحدة',
                'unit_id.exists' => 'يجب اختيار وحدة موجودة',

                'comment.required' => 'يجب كتابة تعليق',
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
