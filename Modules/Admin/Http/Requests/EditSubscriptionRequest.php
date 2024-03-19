<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class EditSubscriptionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|file',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|digits_between:0,' . PHP_INT_MAX,
            'subscription_id' => 'required|exists:subscriptions,id'
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'image.required' => 'يجب اختيار ملف للصورة',
                'image.file' => 'يجب أن تكون الصورة ملف  ',

                'name.required' => 'يجب كتابة اسم للاستراك',
                'name.string' => 'يجب أن يكون اسم الاشتراك نص',

                'description.required' => 'يجب كتابة وصف للاشتراك',
                'description.string' => 'يجب أن يكون الوصف نص',

                'price.required' => 'يجب كتابة سعر للاشتراك',
                'price.digits_between' => 'يجب أن يكون السعر رقم صحيح موجب',

                'subscription_id.required' => 'يجب اختيار اشتراك',
                'subscription_id.exists' => 'يجب أن يكون الاشتراك موجود',
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
