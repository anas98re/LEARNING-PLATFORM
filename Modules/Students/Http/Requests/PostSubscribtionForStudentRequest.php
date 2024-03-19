<?php

namespace Modules\Students\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class PostSubscribtionForStudentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subscription_id' => ['required', Rule::exists('subscriptions', 'id')]
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'subscription_id.required' => 'يجب اختيار اشتراك',
                'subscription_id.exists' => 'يجب اختيار اشتارك موجود',

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
