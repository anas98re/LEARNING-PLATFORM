<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class TransferCenterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'address' => 'required',
            'number' => 'required',
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'name.required' => 'يجب كتابة اسم لمركز التحويل',
                'address.required' => 'يجب كتابة عنوان لمركز التحويل',

                'number.required' => 'يجب كتابة رقم للمركز',
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
