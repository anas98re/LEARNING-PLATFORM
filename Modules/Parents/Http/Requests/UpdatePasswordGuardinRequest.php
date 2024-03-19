<?php

namespace Modules\Parents\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class UpdatePasswordGuardinRequest extends FormRequest
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
        if (App::locale() == 'ar') {
            return [
                'new_password.min' => 'يجب أن يكون طول كلمة السر 8 على الأقل',
                'new_password.required' => 'يجب كتابة كلمة سر جديدة',

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
