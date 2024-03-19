<?php

namespace Modules\Students\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'new_password' => 'required|min:8'
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'new_password.required' => 'يجب كتابة كلمة سر',
                'new_password.min' => 'يجب أن تكون كلمة المرور 8 محارف على الأقل',

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
