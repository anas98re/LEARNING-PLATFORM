<?php

namespace Modules\Admin\Http\Requests;

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
            'payment_image' => 'image|mimes:jpeg,png,jpg,webp,gif,jfif',
            'student_id' => 'required|exists:students,id',
        ];
    }


    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'balance.required' => 'يجب كتابة مبلغ لقيمة الدفع',
                'balance.integer' => 'يجب أن يكون المبلغ رقم صحيح',

                'payment_image.image' => 'يجب اختيار صورة للدفع',
                'payment_image.mimes' => 'jpeg,png,jpg,webp,gif,jfif يجب أن تكون لاحقة الصورة إحدى اللواحق التالية',

                'student_id.required' => 'يجب اختيار طالب',
                'student_id.exists' => 'يجب أن يكون الطالب موجود',

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
