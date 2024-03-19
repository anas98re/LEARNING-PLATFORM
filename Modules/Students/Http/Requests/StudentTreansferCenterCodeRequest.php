<?php

namespace Modules\Students\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class StudentTreansferCenterCodeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'transfer_center_code_id' => "required",
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'transfer_center_code_id.required' => 'يجب اختيار مركز للتحويل',

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
