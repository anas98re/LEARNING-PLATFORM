<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class GetLimitRequest extends FormRequest
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
                'limit.required' => 'يجب وضع حد لعدد العناصر',
                'limit.integer' => 'يجب أن يكون الحد رقم صحيح ',

                'limit.min' => 'الحد الأدنى لقيمة الحد 2',
                'limit.max' => 'الحد الأكبر لقيمة الحد 19',
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
