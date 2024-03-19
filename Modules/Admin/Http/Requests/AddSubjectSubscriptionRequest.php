<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class AddSubjectSubscriptionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject_id' => ['required', Rule::exists('subjects', 'id')],
            'subscription_id' => ['required', Rule::exists('subscriptions', 'id')],
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'subject_id.exists' => 'يجب اختيار درس موجود',
                'subject_id.required' => 'يجب اختيار درس ',

                'subscription_id.exists' => 'يجب اختيار اشتراك موجود',
                'subscription_id.required' => 'يجب اختيار اشتراك',

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
