<?php

namespace Modules\Students\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class PaymentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'balance' => 'required|integer',
            'payment_image' => 'required|image|mimes:jpeg,png,jpg,webp,gif,jfif',
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'balance.required' => 'يجب أن يكون الرصيد موجود',
                'balance.integer' => 'يجب أن يكون الرصيد رقم',

                'payment_image.required' => 'يجب أن تكون الصورة موجودة',
                'payment_image.image' => 'يجب أن يكون الملف صورة',
                'payment_image.mimes' => 'يجب أن تكون لاحقة الصورة ضمن اللواحق التالية jpeg,png,jpg,webp,gif,jfif',

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
